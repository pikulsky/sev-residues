<?php

class PurchaseController extends ShopController
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// the default tab is "New" purchases
		$this->redirect(array('purchase/new'));
	}
	
	public function actionNew()
	{
		if (!empty($_POST)) {
			// processing purchase
			if (isset($_POST['processPurchase']) && isset($_POST['checkboxNewPurchaseId'])) {
				$purchaseIds = $_POST['checkboxNewPurchaseId'];
				if (count($purchaseIds) > 0) {
					Purchase::model()->setPurchaseProcessingStatus($purchaseIds);
					// open "Purchases" page
					$this->redirect(array('purchase/processing'));
				}
			}
		}

		$purchase = new Purchase();
		$this->render('new', array(
			'newPurchasesDataProvider' => $purchase->getNewPurchases(),
		));
	}

	public function actionProcessing()
	{
		if (!empty($_POST)) {

			// delivering purchase
			if(isset($_POST['deliverPurchase']) && isset($_POST['checkboxProcessingPurchaseId'])){
				$purchaseIds = $_POST['checkboxProcessingPurchaseId'];
				if (count($purchaseIds) > 0)
				{
					Purchase::model()->setPurchaseDeliveredStatus($purchaseIds);
					// open "Purchases" page
					$this->redirect(array('purchase/delivered'));
				}
			}
		}

		$purchase = new Purchase();
		$this->render('processing', array(
			'processingPurchasesDataProvider' => $purchase->getProcessingPurchases(),
		));
	}

	public function actionDelivered()
	{
		if (!empty($_POST)) {

			// archiving purchase
			if(isset($_POST['archivePurchase']) && isset($_POST['checkboxDeliveredPurchaseId'])){
				$purchaseIds = $_POST['checkboxDeliveredPurchaseId'];
				if (count($purchaseIds) > 0)
				{
					Purchase::model()->setPurchaseArchivedStatus($purchaseIds);
					// open "archived purchases" page
					$this->redirect(array('purchase/archived'));
				}
			}
		}

		$purchase = new Purchase();

		$this->render('delivered', array(
			'deliveredPurchasesDataProvider' => $purchase->getDeliveredPurchases(),
		));
	}

	public function actionArchived()
	{

		$purchase = new Purchase();

		$this->render('archived', array(
			'archivedPurchasesDataProvider' => $purchase->getArchivedPurchases(),
		));
	}

}