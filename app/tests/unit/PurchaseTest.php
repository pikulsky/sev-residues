<?php

class PurchaseTest extends CDbTestCase {

	public $fixtures = array(
		'shop' => 'Shop',
		'user' => 'User',
		'order' => 'Order',
		'product' => 'Product',
		'balance' => 'Balance',
	);

	/**
	 * Calculates data for tests
	 * @param array $productNames product aliases from fixtures
	 * @return array 
	 */
	protected function _prepareProducts($productNames) {
		
		$productIds = array();
		$totalAmount = 0;
		$newProductsAmount = 0;
		foreach ($productNames as $productName) {
			$productIds[] = $this->product[$productName]['id'];
			$totalAmount += $this->product[$productName]['price'];
			if ($this->product[$productName]['product_status_id'] == Product::PRODUCT_STATUS_NEW) {
				$newProductsAmount += $this->product[$productName]['price'];
			}
		}
		$data = array(
			'ids' => $productIds,
			'amount' => $totalAmount,
			'newProductsAmount' => $newProductsAmount,
		);
		return $data;
	}

	/**
	 * createPurchase:
	 * - all products have "new" status
	 * - same buyer
	 */
	public function testCreatePurchaseNewProducts() {

		// seller should be logged-in
		Yii::app()->user->id = $this->user['seller']['id'];
		// login does not work in test, commented:
		//$identity = new UserIdentity('seller', '');
		//$identity->authenticate();
		//Yii::app()->user->login($identity);

		$products = array(
			'product1',
			'product2',
			'product3',
		);
		$data = $this->_prepareProducts($products);
		$productIds = $data['ids'];
		$expectedPurchaseAmount = $data['amount'];

		$purchase = Purchase::model()->createPurchase($productIds);

		$balance = Balance::model();

		// check a new purchase was created
		$this->assertTrue($purchase instanceof Purchase);
		$this->assertNotEmpty($purchase->id);
		// check purchase amount
		$this->assertEquals($expectedPurchaseAmount, $purchase->amount);
		// check seller balance
		$sellerBalance = $balance->findByPk($this->balance['seller']['id']);
		$this->assertEquals($this->balance['seller']['amount'] + $expectedPurchaseAmount, $sellerBalance->amount);
		// check user balance
		$buyerBalance = $balance->findByPk($this->balance['buyer']['id']);
		$this->assertEquals($this->balance['buyer']['amount'] - $expectedPurchaseAmount, $buyerBalance->amount);
	}

	/**
	 * createPurchase:
	 * - some products have "new" status, some - "paid"
	 * - same buyer
	 */
	public function testCreatePurchaseWithPaidProducts() {

		$balance = Balance::model();

		// seller should be logged-in
		Yii::app()->user->id = $this->user['seller']['id'];
		// login does not work in test, commented:
		//$identity = new UserIdentity('seller', '');
		//$identity->authenticate();
		//Yii::app()->user->login($identity);

		$products = array(
			'product2', // new
			'product3', // new
			'product4', // paid
			'product5', // paid
		);
		$data = $this->_prepareProducts($products);
		$productIds = $data['ids'];
		$expectedPurchaseAmount = $data['amount'];
		$newProductsAmount = $data['newProductsAmount'];

		$purchase = Purchase::model()->createPurchase($productIds);

		// check a new purchase was created
		$this->assertTrue($purchase instanceof Purchase);
		$this->assertNotEmpty($purchase->id);
		// check purchase amount
		$this->assertEquals($expectedPurchaseAmount, $purchase->amount);
		// check seller balance: added amount only for "new" products
		$sellerBalance = $balance->findByPk($this->balance['seller']['id']);
		$this->assertEquals($this->balance['seller']['amount'] + $newProductsAmount, $sellerBalance->amount);
		// check buyer balance: removed amount only for "new" products
		$buyerBalance = $balance->findByPk($this->balance['buyer']['id']);
		$this->assertEquals($this->balance['buyer']['amount'] - $newProductsAmount, $buyerBalance->amount);
	}

	/**
	 * createPurchase:
	 * - some products have "new" status, some - "paid"
	 * - different buyers: "buyer" and "buyer2"
	 * - "buyer2" had no balance before the purchase creation
	 * - products with different currency
	 */
	public function testCreatePurchaseDifferentBuyersWithPaidProductsDifferentCurrency() {
		
	}

	/**
	 * createPurchase:
	 * - some products have "new" status, some - "paid"
	 * - different buyers: "buyer" and "buyer2"
	 * - "buyer2" had no balance before the purchase creation
	 * - all product same currency
	 */
	public function testCreatePurchaseDifferentBuyersWithPaidProducts() {

		$balance = Balance::model();

		// seller should be logged-in
		Yii::app()->user->id = $this->user['seller']['id'];
		// login does not work in test, commented:
		//$identity = new UserIdentity('seller', '');
		//$identity->authenticate();
		//Yii::app()->user->login($identity);

		
		// Products in the test:
		// the first buyer:
		// 'product3' // new
		// 'product4' // paid
		// the second "buyer1"
		// 'product1_buyer2' // new
		// 'product2_buyer2' // paid
		
		$productIds = array(
			$this->product['product3']['id'],
			$this->product['product4']['id'],
			$this->product['product1_buyer1']['id'],
			$this->product['product2_buyer1']['id'],
		);
		$newProductsAmountBuyer = $this->product['product3']['price'];
		$newProductsAmountBuyer1 = $this->product['product1_buyer1']['price'];
		$newProductsAmount = $newProductsAmountBuyer + $newProductsAmountBuyer1;
		$expectedPurchaseAmount =
			$this->product['product4']['price'] +
			$this->product['product2_buyer1']['price'] +
			$newProductsAmount;


		$purchase = Purchase::model()->createPurchase($productIds);

		// check a new purchase was created
		$this->assertTrue($purchase instanceof Purchase);
		$this->assertNotEmpty($purchase->id);
		// check purchase amount
		$this->assertEquals($expectedPurchaseAmount, $purchase->amount);
		// check seller balance: added amount only for "new" products
		$sellerBalance = $balance->findByPk($this->balance['seller']['id']);
		$this->assertEquals($this->balance['seller']['amount'] + $newProductsAmount, $sellerBalance->amount);

		// check the first "buyer" balance: removed amount only for "new" products
		$buyerBalance = $balance->findByPk($this->balance['buyer']['id']);
		$this->assertEquals($this->balance['buyer']['amount'] - $newProductsAmountBuyer, $buyerBalance->amount);

		// check the second "buyer1" balance: removed amount only for "new" products
		$buyer1BalanceId = $balance->getUserBalanceIdInShop(array(
			'user_id' => $this->user['buyer1']['id'],
			'shop_id' => $this->shop['shopA']['id'],
			'currency_id' => $this->product['product2_buyer1']['currency_id'],
		));
		$this->assertNotEmpty($buyer1BalanceId);
		$buyerBalance1 = $balance->findByPk($buyer1BalanceId);
		$this->assertEquals(0 - $newProductsAmountBuyer1, $buyerBalance1->amount);
	}

}
