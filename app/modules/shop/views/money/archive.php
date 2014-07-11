<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?= $this->createUrl('money/invoices'); ?>"><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/balances'); ?>"><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/transactions'); ?>"><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
			<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Archive'); ?></a></li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tabArchive">
				
				<h3><?= Yii::t('ShopModule.money', 'Confirmed invoices'); ?></h3>
<?php

				$paidConfirmedInvoicesDataProvider = new CArrayDataProvider($paidConfirmedInvoicesData, array(
					'id' => 'myDataProvider',
					'keyField' => 'invoiceId',
				));
				
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $paidConfirmedInvoicesDataProvider,
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
							'name' => 'archivedAmountWithCurrency',
							'type' => 'raw',
							'value' => array('Invoice', 'getInvoiceAmountWithCurrency'),
							'header' => Yii::t('invoices', 'Amount'),
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