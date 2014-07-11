<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?= $this->createUrl('purchase/new'); ?>"><?= Yii::t('ShopModule.money', 'New'); ?></a></li>
			<li><a href="<?= $this->createUrl('purchase/processing'); ?>"><?= Yii::t('ShopModule.money', 'Processing'); ?></a></li>
			<li><a href="<?= $this->createUrl('purchase/delivered'); ?>"><?= Yii::t('ShopModule.money', 'Delivered'); ?></a></li>
			<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Archived'); ?></a></li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tabArchivedPurchases">
<?php
				$form = $this->beginWidget('CActiveForm');
?>
<?php
				$this->widget('zii.widgets.grid.CGridView', array(
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
					'dataProvider' => $archivedPurchasesDataProvider,
					// ? 'filter' => $model,

					// 'type' for TbJsonGridView
					//'type' => 'striped bordered condensed',
					// 'summaryText' => false,
					// 'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
					// 'cacheTTLType' => 's', // type can be of seconds, minutes or hours
					
					'columns' => array(
						'id',
						array(
							'name' => 'archivedPurchasesAmountWithCurrency',
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
				$this->endWidget();
?>				
			</div> <!-- /div class="tab-pane active" id="tabArchivedPurchases" -->
				
		</div> <!-- /div class="tab-content" -->
</div> <!-- /div class="tabbable" -->