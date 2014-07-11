
<div class="tabbable">
	<ul class="nav nav-tabs">
		<li><a href="<?= $this->createUrl('money/invoices'); ?>"><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>
		<li><a href="<?= $this->createUrl('money/balances'); ?>"><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
		<li><a href="<?= $this->createUrl('money/transactions'); ?>"><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
		<li><a href="<?= $this->createUrl('money/archive'); ?>"><?= Yii::t('ShopModule.money', 'Archive'); ?></a></li>
	</ul>
	<div class="tab-content">
	<div class="tab-pane active">

	<h3><?= Yii::t('money', 'Transactions'); ?></h3>

<?php
				$dataProvider = new CArrayDataProvider($transactionsData, array(
					'id' => 'myDataProvider',
					'keyField' => 'transactionId',
				));

				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $dataProvider,

					'columns' => array(
						'shopName::'. Yii::t('payments', 'Shop Name'),
						'balanceId::'. Yii::t('payments', 'Balance Id'),
						'balanceName::'. Yii::t('payments', 'Balance Name'),
						'transactionId::'. Yii::t('payments', 'Transaction Id'),
						array(
							'name' => 'transactionPriceWithCurrency',
							'type' => 'raw',
							'value' => array('Transaction', 'getTransactionPriceWithCurrency'),
							'header' => Yii::t('transactions', 'Amount'),
						),
						array(
							'name' => 'transactionStatusName',
							'type' => 'raw',
							'value' => array('Transaction', 'getStatusName'),
							'header' => Yii::t('payments', 'Transaction Status Name'),
						),
						'transactionComment::'. Yii::t('payments', 'Transaction Comment'),
						'transactionCreated::'. Yii::t('payments', 'Transaction Created'),

					),
				));
?>

	</div><!-- /tab-pane -->
	</div> <!-- /tab-content -->
</div> <!-- /tabbable -->
