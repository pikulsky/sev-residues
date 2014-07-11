	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?= $this->createUrl('order/new'); ?>"><?= Yii::t('orders', 'New'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/waitpayment'); ?>"><?= Yii::t('orders', 'Wait Payment'); ?></a></li>
			<li class="active"><a href=""><?= Yii::t('orders', 'Processing'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/invalid'); ?>"><?= Yii::t('orders', 'Invalid'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/archived'); ?>"><?= Yii::t('orders', 'Archived'); ?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tabProcessingOrders">
				<?php
				$form = $this->beginWidget('CActiveForm');
?>
<?php
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $processingProductsDataProvider,
					// ? 'filter' => $model, note: if filter is used, then add hidden Filter button
					// as a first submit button to catch ENTER hit from user

					// 'type' for TbJsonGridView
					//'type' => 'striped bordered condensed',

					// 'summaryText' => false,
					// 'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
					// 'cacheTTLType' => 's', // type can be of seconds, minutes or hours
					
					'columns' => array(
						array(
							'id' => 'checkboxProductId',
							'class' => 'CCheckBoxColumn',
							'selectableRows' => 20, // TODO from param: rows per page
						),						
						'id',
						array(
							'name' => 'shop_name',
							'header' => Yii::t('orders', 'Shopname'),
						),
						array(
							'name' => 'title',
							'header' => Yii::t('orders', 'Title'),
						),
						array(
							'name' => 'price',
							'header' => Yii::t('orders', 'Price'),
						),
						array(
							'name' => 'quantity',
							'header' => Yii::t('orders', 'Quantity'),
						),
						array(
							'name' => 'created',
							'header' => Yii::t('orders', 'Order date'),
							//'type' => 'datetime',
							'value' => 'date("M j, Y", strtotime($data->created))',
						),
						'order_id',
						array(
							'header' => Yii::t('orders', 'Edit'),
							'class' => 'zii.widgets.grid.CButtonColumn',
							// for TbJsonGridView
//							'class' => 'bootstrap.widgets.TbJsonButtonColumn',
							'template' => '{view} {delete}',
						),
					),
				));
?>
<?php
				$this->endWidget();
?>
			</div>
		</div>
	</div>