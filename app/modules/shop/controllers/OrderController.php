<?php

class OrderController extends ShopController
{
	public $defaultAction = 'index';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
//			// page action renders "static" pages stored under 'protected/views/site/pages'
//			// They can be accessed via: index.php?r=site/page&view=FileName
//			'page'=>array(
//				'class'=>'CViewAction',
//			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// the default tab is "New"
		$this->redirect(array('order/new'));
	}

	public function actionCreate()
	{
		$shopname = Yii::app()->getRequest()->getParam('shopname', 'NO SHOPNAME');

		// one more check for the case when URL was build by user,
		// (without using createUrl() method)
		$shop_id = User::model()->getShopIdByName($shopname);
		if (!$shop_id) {
			$shopname = 'NO SHOPNAME';
		}

		$product = new Product();
		$product->shop_id = $shop_id;

		if(!empty($_POST)) {

			$product->attributes = $_POST;

			if ($product->validate()) {
				if ($product->save()) {
					$this->redirect(array('order/new'));
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
		$this->render('create', array(
			'model' => $product,
			'shopname' => $shopname,
			'currencyList' => $currencyList,
		));
	}

	public function actionNew()
	{
		if (!empty($_POST)) {

			// create purchase
			if(isset($_POST['createPurchase']) && isset($_POST['checkboxProductId'])){
				$productIds = $_POST['checkboxProductId'];
				if (count($productIds) > 0)
				{
					Purchase::model()->createPurchase($productIds);
					// open "Purchases" page
					$this->redirect(array('purchase/index'));
				}
			}
			// create invoice
			if(isset($_POST['createInvoice']) && isset($_POST['checkboxProductId'])){
				$productIds = $_POST['checkboxProductId'];
				if (count($productIds) > 0)
				{
					Product::createInvoice($productIds);
					// reload current page
					$this->redirect(array('order/index'));
				}
			}
		}
		
		$shopId = User::model()->getCurrentSellerShopId();
		$shopName = User::model()->getCurrentSellerShopName();

		$product = new Product();
		// renders the view file 'protected/views/order/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$options = array(
			'shop_id' => $shopId,
		);
		$this->render('new', array(
			'newAndPaidProductsDataProvider' => $product->getNewAndPaidProducts($options),
			'shopName' => $shopName,
		));
	}

	public function actionWaitPayment()
	{
		$shopId = User::model()->getCurrentSellerShopId();
		$shopName = User::model()->getCurrentSellerShopName();

		$product = new Product();
		// renders the view file 'protected/views/order/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$options = array(
			'shop_id' => $shopId,
		);
		$this->render('waitpayment', array(
			'waitPaymentProductsDataProvider' => $product->getWaitPaymentProducts($options),
			'shopName' => $shopName,
		));
	}

	public function actionProcessing()
	{
		$shopId = User::model()->getCurrentSellerShopId();

		$product = new Product();
		$options = array(
			'shop_id' => $shopId,
		);
		
		$this->render('processing', array(
			'processingProductsDataProvider' => $product->getProcessingProducts($options),
		));
	}

	public function actionInvalid()
	{
		$shopId = User::model()->getCurrentSellerShopId();

		$product = new Product();
		$options = array(
			'shop_id' => $shopId,
		);
		
		$this->render('invalid', array(
			'invalidProductsDataProvider' => $product->getInvalidProducts($options),
		));
	}

	public function actionArchived()
	{
		$shopId = User::model()->getCurrentSellerShopId();

		$product = new Product();
		$options = array(
			'shop_id' => $shopId,
		);
		
		$this->render('archived', array(
			'archivedProductsDataProvider' => $product->getArchivedProducts($options),
		));
	}

}