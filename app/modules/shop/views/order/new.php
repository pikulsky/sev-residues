 	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href=""><?= Yii::t('orders', 'New'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/waitpayment'); ?>"><?= Yii::t('orders', 'Wait Payment'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/processing'); ?>"><?= Yii::t('orders', 'Processing'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/invalid'); ?>"><?= Yii::t('orders', 'Invalid'); ?></a></li>
			<li><a href="<?= $this->createUrl('order/archived'); ?>"><?= Yii::t('orders', 'Archived'); ?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tabNewOrders">

<?php
				$form = $this->beginWidget('CActiveForm');
?>

<?php
				// below code: http://yii-booster.clevertech.biz/json-grid.html
				// CGridView  http://habrahabr.ru/post/156251/
				// http://belyakov.su/content/yii-rabota-s-cgridview-s-ispolzovaniem-cjuidialog-and-ajax
				// http://psyhos.blogspot.com/2011/08/cgridview.html
				// http://yii.vingtsun-grodno.com/zii-widgets-grid-cgridview/
				// http://www.yiiframework.com/doc/api/1.1/CGridView
				// http://www.yiiframework.com/forum/index.php/topic/28117-cgridview-%D0%BD%D0%B0-%D1%80%D1%83%D1%81%D1%81%D0%BA%D0%BE%D0%BC/

				// Grid with checkboxes
				// http://www.yiiframework.com/wiki/353/working-with-cgridview-in-admin-panel/


				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $newAndPaidProductsDataProvider,
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
							'name' => 'title',
							'header' => Yii::t('orders', 'Title'),
						),
						'shop_id',
						array(
							'name' => 'newOrderPriceWithCurrency',
							'type' => 'raw',
							'value' => array('Product', 'getProductPriceWithCurrency'),
							'header' => Yii::t('orders', 'Price'),
						),
						array(
							'name' => 'shop_name',
							'header' => Yii::t('orders', 'Shopname'),
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
							'name' => 'product_status_name',
							'header' => Yii::t('orders', 'Product status'),
						),
						array(
							'name' => 'created',
							'header' => Yii::t('orders', 'Order date'),
							//'type' => 'datetime',
							'value' => 'date("M j, Y", strtotime($data->created))',
						),
						'order_id',
						'user_id',
						array(
							'name' => 'username',
							'header' => Yii::t('orders', 'Buyer'),
						),
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
				echo CHtml::submitButton(Yii::t('orders', 'Create purchase'), array(
					'name' => 'createPurchase',
				));
?>

<?php
				echo CHtml::submitButton(Yii::t('ShopModule.money', 'Create invoice'), array(
					'name' => 'createInvoice',
				));
?>
<?php
				$this->endWidget();
?>
			</div>
		</div>
	</div>