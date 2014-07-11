<?php
	/* @var $this MoneyController */

	$this->pageTitle = Yii::t('ShopModule.money', 'Money') . ' - ' . Yii::t('main', Yii::app()->name);
?>

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?= $this->createUrl('money/invoices'); ?>"><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>
			<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/transactions'); ?>"><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
			<li><a href="<?= $this->createUrl('money/archive'); ?>"><?= Yii::t('ShopModule.money', 'Archive'); ?></a></li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tabBalance">
				<div>
					<a class="btn btn-success" href="<?= $this->createUrl('money/new'); ?>"><?= Yii::t('money', 'Add money to buyer balance'); ?></a>
				</div>
<?php

				$dataProvider = new CArrayDataProvider($balanceData, array(
					'id' => 'myDataProvider',
					'keyField' => 'balanceId',
				));

				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $dataProvider,
					
				'columns' => array(
						'balanceName:raw:'. Yii::t('payments', 'Balance Name'),
						array(
							'name' => 'transactionStatusId',
							'type' => 'raw',
							'value' => array('Balance', 'getAmountWithCurrency'),
							'header' => Yii::t('balance', 'Balance amount'),
						),
						array(
							'class' => 'CButtonColumn',
							'template' => '{view}',
							'buttons' => array(
								'view' => array(
									'label' => Yii::t('money', 'View'),
									// no image, text link
									'imageUrl' => false,
									// createUrl() is called from controller
									'url' => 'Yii::app()->controller->createUrl("money/balance", array("id" => $data["balanceId"]))',
								),
							), // buttons	
						),
					
					),// columns
				));
?>
			</div><!-- /tabBalance -->

		</div>
	</div>
