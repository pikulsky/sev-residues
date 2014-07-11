<?php
	/* @var $this MoneyController */

	$this->pageTitle = Yii::t('ShopModule.money', 'Money') . ' - ' . Yii::t('main', Yii::app()->name);
?>

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?= $this->createUrl('money/invoices'); ?>"><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/balances'); ?>"><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
			<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/archive'); ?>"><?= Yii::t('ShopModule.money', 'Archive'); ?></a></li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tabTransaction">
<?php

				$dataProvider = new CArrayDataProvider($transactionData, array(
					'id' => 'myDataProvider',
					'keyField' => 'transactionId',
				));

				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $dataProvider,
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
						//'userUsername:raw:'. Yii::t('payments', 'User Username'),
						'fromBalanceId:raw:'. Yii::t('payments', 'Balance Id'),
						'fromBalanceName:raw:'. Yii::t('payments', 'From Balance Name'),
						'toBalanceId:raw:'. Yii::t('payments', 'Balance Id'),
						'toBalanceName:raw:'. Yii::t('payments', 'To Balance Name'),
						'transactionId:raw:'. Yii::t('payments', 'Transaction Id'),
						array(
							'name' => 'transactionPriceWithCurrency',
							'type' => 'raw',
							'value' => array('Transaction', 'getTransactionPriceWithCurrency'),
							'header' => Yii::t('transactions', 'Amount'),
						),
						array(
							'name' => 'transactionStatusId',
							'type' => 'raw',
							'value' => array('Transaction', 'getStatusName'),
							'header' => Yii::t('payments', 'Transaction Status Name'),
						),
						'transactionComment:raw:'. Yii::t('payments', 'Transaction Comment'),
						'transactionCreated:raw:'. Yii::t('payments', 'Transaction Created'),

					),
				));
?>
			</div> <!-- /tabTransaction -->

		</div>
	</div>
