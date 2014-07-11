<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?= $this->createUrl('purchase/new'); ?>"><?= Yii::t('ShopModule.money', 'New'); ?></a></li>
			<li><a href="<?= $this->createUrl('purchase/processing'); ?>"><?= Yii::t('ShopModule.money', 'Processing'); ?></a></li>
			<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Delivered'); ?></a></li>
			<li><a href="<?= $this->createUrl('purchase/archived'); ?>"><?= Yii::t('ShopModule.money', 'Archived'); ?></a></li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tabDeliveredPurchases">
<?php
				$form = $this->beginWidget('CActiveForm');
?>
<?php
				$this->widget('zii.widgets.grid.CGridView', array(
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
					'dataProvider' => $deliveredPurchasesDataProvider,
					// ? 'filter' => $model,

					// 'type' for TbJsonGridView
					//'type' => 'striped bordered condensed',

					// 'summaryText' => false,
					// 'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
					// 'cacheTTLType' => 's', // type can be of seconds, minutes or hours
					
					'columns' => array(
						array(
							'id' => 'checkboxDeliveredPurchaseId',
							'class' => 'CCheckBoxColumn',
							'selectableRows' => 20, // TODO from param: rows per page
						),						
						'id',
						array(
							'name' => 'deliveredPurchasesAmountWithCurrency',
							'type' => 'raw',
							'value' => array('Purchase', 'getPurchaseAmountWithCurrency'),
							'header' => Yii::t('purchases', 'Amount'),
						),
						array(
							'name' => 'created',
							'value' => 'date("M j, Y", strtotime($data->created))',
						),
						array(
							'name' => 'purchase_status_id',
							'type' => 'raw',
							'value' => '$data->getStatus($data->purchase_status_id)'
						),
						array(
							'header' => Yii::t('purchases', 'Edit'),
							// for TbJsonGridView
							//'class' => 'bootstrap.widgets.TbJsonButtonColumn',
							'class' => 'zii.widgets.grid.CButtonColumn',
							//'template' => '{view} {delete}',
						),
					),
				));
?>
<?php
				echo CHtml::submitButton(Yii::t('purchases', 'Archive purchase'), array(
					'name' => 'archivePurchase',
				));
?>
<?php
				$this->endWidget();
?>				
			</div>	
				
		</div>
</div>