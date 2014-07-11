<?php

class TransactionTest extends CDbTestCase
{
	public $fixtures = array(
		'shop' => 'Shop',
		'balance' => 'Balance',
	);

	public function testCreateTransaction()
	{
		//
		$options  = array(
			'from_balance_id' => $this->balance['buyer']['id'],
			'to_balance_id' => $this->balance['seller']['id'],
			'amount' => 105,
			'currency_id' => Currency::CURRENCY_UAH,
			'transaction_status_id' => Transaction::TRANSACTION_STATUS_CONFIRMED,
		);
		$transaction = Transaction::model()->createTransaction($options);

		// check transaction was created
		$this->assertTrue($transaction instanceof Transaction);
		$this->assertNotEmpty($transaction->id);

		// check data
		$testTransaction = Transaction::model()->findByPk($transaction->id);
		$this->assertEquals($testTransaction->from_balance_id, $options['from_balance_id']);
		$this->assertEquals($testTransaction->to_balance_id, $options['to_balance_id']);
		$this->assertEquals($testTransaction->amount, $options['amount']);
		$this->assertEquals($testTransaction->currency_id, $options['currency_id']);
		$this->assertEquals($testTransaction->transaction_status_id, $options['transaction_status_id']);
	}
	
}