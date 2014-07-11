<?php

class InvoiceTest extends CDbTestCase {

	public $fixtures = array(
		'shop' => 'Shop',
		'user' => 'User',
		'order' => 'Order',
		'product' => 'Product',
	);

	public function testCreateInvoice2() {

		//$invoiceIds =
		//InvoiceFactory::setInvoicesPaidNonConfirmedStatus($invoiceIds);
	}
	/**
	 * Creates invoice:
	 * - products from different buyers
	 * - product same currency (TODO: different currency)
	 * - some products "new", some not "new"
	 */
	public function testCreateInvoice()
	{
		// seller should be logged-in
		Yii::app()->user->id = $this->user['seller']['id'];

		$newProductIdsBuyer1 = array(
			$this->product['product2']['id'], // new
			$this->product['product3']['id'], // new
		);
		$newProductIdsBuyer2 = array(
			$this->product['product1_buyer1']['id'], // new
			$this->product['product3_buyer1']['id'], // new
		);
		$newProductIds = array_merge($newProductIdsBuyer1, $newProductIdsBuyer2);
		$paidProductIds = array(
			$this->product['product4']['id'], // paid
			$this->product['product2_buyer1']['id'], // paid
		);
		$productIds = array_merge($newProductIds, $paidProductIds);
		$invoiceIds = Product::createInvoice($productIds);
		
		// there are two invoices (one per buyer)
		$this->assertEquals(2, count($invoiceIds));

		$invoiceByBuyerId = array();
		foreach ($invoiceIds as $invoiceId) {
			$invoice = Invoice::model()->findByPk($invoiceId);
			$this->assertTrue($invoice instanceof Invoice);
			$this->assertNotEmpty($invoice->id);
			// collect invoices by buyer id
			$invoiceByBuyerId[$invoice->buyer_id][] = $invoice;
		}
		// one invoce for the 1st user
		$this->assertEquals(1, count($invoiceByBuyerId[$this->user['buyer']['id']]));
		// one invoce for the 2nd user
		$this->assertEquals(1, count($invoiceByBuyerId[$this->user['buyer1']['id']]));
		
		$invoiceBuyer1 = $invoiceByBuyerId[$this->user['buyer']['id']][0];
		$invoiceBuyer2 = $invoiceByBuyerId[$this->user['buyer1']['id']][0];

		// test invoice properties
		
		// status:
		$this->assertEquals(Invoice::INVOICE_STATUS_NEW, $invoiceBuyer1->invoice_status_id);
		$this->assertEquals(Invoice::INVOICE_STATUS_NEW, $invoiceBuyer2->invoice_status_id);
			
		// amount:
		// only "new" products are added to invoice
		// products with "new" status from the 1st buyer
		$expectedInvoiceAmountBuyer1 = $this->product['product2']['price'] +
			$this->product['product3']['price'];
		// products with "new" status from the 2nd buyer
		$expectedInvoiceAmountBuyer2 = $this->product['product1_buyer1']['price'] +
			$this->product['product3_buyer1']['price'];
		// amounts:
		$this->assertEquals($expectedInvoiceAmountBuyer1, $invoiceBuyer1->amount);
		$this->assertEquals($expectedInvoiceAmountBuyer2, $invoiceBuyer2->amount);
		
		// products with "new" status now have "waiting payment" status
		foreach ($newProductIds as $productId) {
			$product = Product::model()->findByPk($productId);
			$this->assertEquals(Product::PRODUCT_STATUS_WAIT_FOR_PAYMENT, $product->product_status_id);
		}
		// products with "paid" status didn't changed: they have "paid" status
		foreach ($paidProductIds as $productId) {
			$product = Product::model()->findByPk($productId);
			$this->assertEquals(Product::PRODUCT_STATUS_PAID, $product->product_status_id);
		}

		$invoice = Invoice::model();
		// check invoice's products: the 1st buyer
		$invoiceProductIds = $invoice->getInvoiceProducts($invoiceBuyer1->id);
		$this->assertEquals(count($newProductIdsBuyer1), count($invoiceProductIds));
		foreach ($newProductIdsBuyer1 as $productId) {
			$this->assertTrue(in_array($productId, $invoiceProductIds));
		}
		// check invoice's products: the 2nd buyer
		$invoiceProductIds = $invoice->getInvoiceProducts($invoiceBuyer2->id);
		$this->assertEquals(count($newProductIdsBuyer2), count($invoiceProductIds));
		foreach ($newProductIdsBuyer2 as $productId) {
			$this->assertTrue(in_array($productId, $invoiceProductIds));
		}

	}
}