<?php

class CurrencyTest extends CDbTestCase {

	public $fixtures = array(
		'shop' => 'Shop',
		'user' => 'User',
		'currency' => 'Currency',
		'currency_rate' => 'CurrencyRate',
	);


	public function testGetCurrentCurrencyRate() {

		$shop_id = $this->shop['shopA']['id'];
		$currency_id = $this->currency['currency-usd']['id'];
		$currency = Currency::model();
		$currency_rate = $currency->getCurrentCurrencyRate($shop_id, $currency_id);
		$this->assertEquals($this->currency_rate['shop-1-usd-rate']['currency_rate'], $currency_rate);

		// shop D does not have rate for EUR
		$shop_id = $this->shop['shopD']['id'];
		$currency_id = $this->currency['currency-eur']['id'];
		$currency_rate = $currency->getCurrentCurrencyRate($shop_id, $currency_id);
		$this->assertNull($currency_rate);

	}

	public function testSaveNewCurrencyRate() {

		$data = array(
			'new_currency_id' => $this->currency['currency-eur']['id'],
			'shop_id' => $this->shop['shopA']['id'],
			'seller_id' => 1,
			'new_currency_rate' => 15,
		);

		$currency = Currency::model();
		$new_currency_rate = $currency->saveNewCurrencyRate($data);
		$currency_rate = CurrencyRate::model()->findByPk($new_currency_rate->id);

		$this->assertEquals($data['seller_id'], $currency_rate->seller_id);
		$this->assertEquals($data['shop_id'], $currency_rate->shop_id);
		$this->assertEquals($data['new_currency_rate'], $currency_rate->currency_rate);

	}


	public function testGetBaseCurrencyByShopId(){

		$shop_id = $this->shop['shopA']['id'];

		$currency = Currency::model();
		$base_currency_info = $currency->getBaseCurrencyByShopId($shop_id);
		$base_currency_id = $base_currency_info['base_currency_id'];
		$base_currency_name = $base_currency_info['name'];

		$this->assertEquals($this->shop['shopA']['base_currency_id'], $base_currency_id);
		$this->assertEquals($this->currency['currency-uah']['name'], $base_currency_name);

	}


	public function testGetActualCurrencyRates() {

		$shop_id = $this->shop['shopA']['id'];

		$currency = Currency::model();
		$actual_currencies = $currency->getActualCurrencyRates($shop_id);

		$this->assertEquals(count($actual_currencies), 2);

		$this->assertEquals($this->currency_rate['shop-1-usd-rate']['id'], $actual_currencies[0]['id']);
		$this->assertEquals($this->currency['currency-usd']['name'], $actual_currencies[0]['name']);
		$this->assertEquals($this->currency_rate['shop-1-usd-rate']['currency_rate'], $actual_currencies[0]['currency_rate']);
		$this->assertEquals($this->currency_rate['shop-1-eur-rate']['id'], $actual_currencies[1]['id']);
		$this->assertEquals($this->currency['currency-eur']['name'], $actual_currencies[1]['name']);
		$this->assertEquals($this->currency_rate['shop-1-eur-rate']['currency_rate'],  $actual_currencies[1]['currency_rate']);

	}


	public function testGetAvailableCurrenciesByShopId(){

		$shop_id = $this->shop['shopD']['id'];
		$currency = Currency::model();
		$data = array(
			'shop_id' => $shop_id,
			'shop_base_currency_id' => $currency->getBaseCurrencyByShopId($shop_id)['base_currency_id'],
		);

		$available_currencies = $currency->getAvailableCurrenciesByShopId($data);

		$this->assertEquals(count($available_currencies), 1);

		$this->assertEquals($this->currency['currency-eur']['id'], $available_currencies[0]['id']);
		$this->assertEquals($this->currency['currency-eur']['name'], $available_currencies[0]['name']);

	}

}