<?php

class MoneyController extends ShopController
{
	public $defaultAction = 'index';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// the default tab is "Invoices"
		$this->redirect(array('money/invoices'));
	}

	public function actionTransactions()
	{
		$userId = User::model()->getCurrentUserId();

		$transactionData = Transaction::model()->getTransactions($userId);

		$this->render('transactions', array(
			'transactionData' => $transactionData,
		));
	}

	public function actionBalances()
	{
		$userId = User::model()->getCurrentUserId();

		$balance = Balance::model();
		$balanceData = $balance->getBalances($userId);
		
		$this->render('balances', array(
			'balanceData' => $balanceData,
		));
	}

	public function actionInvoices()
	{
		$invoice = Invoice::model();

		if (!empty($_POST)) {

			// processing invoices
			if(isset($_POST['paymentReceived']) && isset($_POST['checkboxInvoiceId'])){
				$invoiceIds = $_POST['checkboxInvoiceId'];
				if (count($invoiceIds) > 0) 
				{
					$invoice->setInvoicesPaidConfirmedStatus($invoiceIds);
				}
			}
			// open "Invoices" page
			$this->redirect(array('money/invoices'));
		}

		$shopId = User::model()->getCurrentSellerShopId();

		$options = array(
			'shop_id' => $shopId,
		);

		$newInvoicesData = $invoice->getNewInvoices($options);
		$paidNonConfirmedInvoicesData = $invoice->getPaidNonConfirmedInvoices($options);
		$paidConfirmedInvoicesData = $invoice->getPaidConfirmedInvoices($options);

		$this->render('invoices', array(
			'newInvoicesData' => $newInvoicesData,
			'paidNonConfirmedInvoicesData' => $paidNonConfirmedInvoicesData,
			'paidConfirmedInvoicesData' => $paidConfirmedInvoicesData,
		));
	}
	
	public function actionNew()
	{
		$transaction = new Transaction();
		

		if(!empty($_POST)) {

			$transaction->attributes = $_POST;
			
			$transaction->transaction_status_id = Transaction::TRANSACTION_STATUS_CONFIRMED;

			$userId = $_POST['user_id'];

			if ($transaction->validate()) {
				
				$balance = Balance::model();
				$shopId = User::model()->getCurrentSellerShopId();

				$options = array(
					'user_id' => $userId,
					'shop_id' => $shopId,
					'currency_id' => $transaction->currency_id,
				);
				$userBalanceId = $balance->getUserBalanceIdInShop($options);

				if (empty($userBalanceId)) {
					$userBalanceId = $balance->createUserBalanceInShop($options);
				}

				$transaction->to_balance_id = $userBalanceId;
				
				if ($transaction->save()) {

					// update balance
					$transaction->updateBalances();
					
					$this->redirect(array('money/index'));
				} else {
					// failed to save product
					// TODO: show error
				}
			} else {
				// validation error
			}
		}
		
		$currency = Currency::model();
		$currencyList = $currency->getCurrencies();


		$shopId = User::model()->getCurrentSellerShopId();
		$usersForSellerList = User::model()->getUsersForSeller($shopId);
		
		$this->render('new', array(
			'model' => $transaction,
			'usersForSellerList' => $usersForSellerList,
			'currencyList' => $currencyList,
		));
	}

	public function actionBalance()
	{
		$balanceId = Yii::app()->getRequest()->getQuery('id');

		$transactionsData = Transaction::model()->getTransactionsForBalance($balanceId);

		$this->render('balance', array(
			'transactionsData' => $transactionsData,
		));
	}
	
	public function actionArchive()
	{
		
		$shopId = User::model()->getCurrentSellerShopId();

		$options = array(
			'shop_id' => $shopId,
		);

		$invoice = new Invoice();
		$paidConfirmedInvoicesData = $invoice->getPaidConfirmedInvoices($options);

		$this->render('archive', array(
			'paidConfirmedInvoicesData' => $paidConfirmedInvoicesData,
		));
	}
}