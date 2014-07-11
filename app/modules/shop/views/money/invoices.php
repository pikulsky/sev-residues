<?php
	/* @var $this MoneyController */

	$this->pageTitle = Yii::t('main', 'Payments') . ' - ' . Yii::t('main', Yii::app()->name);
?>


	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/balances'); ?>"><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/transactions'); ?>"><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/archive'); ?>"><?= Yii::t('ShopModule.money', 'Archive'); ?></a></li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tabInvoices">
<?php
				$form = $this->beginWidget('CActiveForm');
?>
				<h3><?= Yii::t('invoices', 'Paid non-confirmed invoices'); ?></h3>
<?php

				$paidNonConfirmedInvoicesDataProvider = new CArrayDataProvider($paidNonConfirmedInvoicesData, array(
					'id' => 'myDataProvider',
					'keyField' => 'invoiceId',
				));
				
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $paidNonConfirmedInvoicesDataProvider,
					// ? 'filter' => $model, note: if filter is used, then add hidden Filter button
					// as a first submit button to catch ENTER hit from user

					// 'type' for TbJsonGridView
					//'type' => 'striped bordered condensed',

					// 'summaryText' => false,
					// 'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
					// 'cacheTTLType' => 's', // type can be of seconds, minutes or hours
					
					'columns' => array(
						array(
							'id' => 'checkboxInvoiceId',
							'class' => 'CCheckBoxColumn',
							'selectableRows' => 20, // TODO from param: rows per page
						),				
						'invoiceId',
						array(
							'name' => 'invoiceAmountWithCurrency',
							'type' => 'raw',
							'value' => array('Invoice', 'getInvoiceAmountWithCurrency'),
							'header' => Yii::t('invoices', 'Invoice amount'),
						),
						'buyer_id',
						array(
							'name' => 'invoice_status_id',
							'type' => 'raw',
							'value' => array('Invoice', 'getStatusName'),
							'header' => Yii::t('payments', 'Status'),
						),
					),
				));
?>
<?php
				echo CHtml::submitButton(Yii::t('payments', 'Payment received'), array(
					'name' => 'paymentReceived',
				));
?>
				
<?php
				$this->endWidget();
?>	

				<h3><?= Yii::t('invoices', 'New invoices'); ?></h3>
<?php
				$newInvoicesDataProvider = new CArrayDataProvider($newInvoicesData, array(
					'id' => 'myDataProvider',
					'keyField' => 'invoiceId',
				));
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $newInvoicesDataProvider,
					// ? 'filter' => $model, note: if filter is used, then add hidden Filter button
					// as a first submit button to catch ENTER hit from user

					// 'type' for TbJsonGridView
					//'type' => 'striped bordered condensed',

					// 'summaryText' => false,
					// 'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
					// 'cacheTTLType' => 's', // type can be of seconds, minutes or hours
					
					'columns' => array(
						array(
							'id' => 'checkboxInvoiceId',
							'class' => 'CCheckBoxColumn',
							'selectableRows' => 20, // TODO from param: rows per page
						),				
						'id',
						array(
							'name' => 'invoiceAmountWithCurrency',
							'type' => 'raw',
							'value' => array('Invoice', 'getInvoiceAmountWithCurrency'),
							'header' => Yii::t('invoices', 'Invoice amount'),
						),
						'buyer_id',
						array(
							'name' => 'invoice_status_id',
							'type' => 'raw',
							'value' => array('Invoice', 'getStatusName'),
							'header' => Yii::t('payments', 'Status'),
						),
					),
				));
?>

			
			</div>

		</div>
	</div>
