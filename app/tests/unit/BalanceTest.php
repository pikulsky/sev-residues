<?php

class BalanceTest extends CDbTestCase
{
	public $fixtures = array(
		'shop' => 'Shop',
		'user' => 'User',
		'balance' => 'Balance',
		'order' => 'Order',
		'product' => 'Product',
	);

	public function testAddAmountToBalance()
	{
		$balance = Balance::model();

		$balanceId = $this->balance['buyer']['id'];
		$amount = $this->balance['buyer']['amount'];

		$increasedDelta = 55;
		// increase amount
		$balance->addAmountToBalance($balanceId, $increasedDelta);
		$buyerBalance = Balance::model()->findByPk($balanceId);
		// expected amount
		$amount += $increasedDelta;
		$this->assertEquals($buyerBalance->amount, $amount);

		$decreasedDelta = -75;
		// decrease amount
		$balance->addAmountToBalance($balanceId, $decreasedDelta);
		$buyerBalance = Balance::model()->findByPk($balanceId);

		// expected amount
		$amount += $decreasedDelta;
		$this->assertEquals($buyerBalance->amount, $amount);
	}

	public function testGetBalances()
	{
		$balance = Balance::model();

		// check buyer's balance
		$buyerBalances = $balance->getBalances($this->user['buyer']['id']);
		$this->assertEquals(count($buyerBalances), 1);
		$this->assertEquals($this->balance['buyer']['id'], $buyerBalances[0]['balanceId']);
		$this->assertEquals($this->balance['buyer']['name'], $buyerBalances[0]['balanceName']);
		$this->assertEquals($this->balance['buyer']['amount'], $buyerBalances[0]['balanceAmount']);
		$this->assertEquals('UAH', $buyerBalances[0]['currencyName']);
		$this->assertEquals($this->shop['shopA']['name'], $buyerBalances[0]['shopName']);

		// check seller's balance
		$sellerBalances = $balance->getBalances($this->user['seller']['id']);
		$this->assertEquals(count($sellerBalances), 1);
		$this->assertEquals($this->balance['seller']['id'], $sellerBalances[0]['balanceId']);
		$this->assertEquals($this->balance['seller']['name'], $sellerBalances[0]['balanceName']);
		$this->assertEquals($this->balance['seller']['amount'], $sellerBalances[0]['balanceAmount']);
		$this->assertEquals('UAH', $sellerBalances[0]['currencyName']);
	}

	public function testUpdateBalancesForProduct()
	{
		$buyerBalance = Balance::model()->findByPk($this->balance['buyer']['id']);
		$buyerBalanceAmount = $buyerBalance->amount;

		$sellerBalance = Balance::model()->findByPk($this->balance['seller']['id']);
		$sellerBalanceAmount = $sellerBalance->amount;

		$options  = array(
			'seller_id' => $this->user['seller']['id'],
			'shop_id' => $this->shop['shopA']['id'],
		);

		$product = Product::model()->findByPk($this->product['product1']['id']);
		$this->assertTrue($product instanceof Product);
		$this->assertNotEmpty($product->id);
		
		Purchase::model()->updateBalancesForProduct($product, $options);

		// check seller's balance
		$sellerBalance = Balance::model()->findByPk($this->balance['seller']['id']);
		$this->assertEquals($sellerBalanceAmount + $this->product['product1']['price'], $sellerBalance->amount);

		// check buyer's balance
		$buyerBalance = Balance::model()->findByPk($this->balance['buyer']['id']);
		$this->assertEquals($buyerBalanceAmount - $this->product['product1']['price'], $buyerBalance->amount);
	}

}