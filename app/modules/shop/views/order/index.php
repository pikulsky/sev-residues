<?php
	/* @var $this OrderController */
	/* @var $shopName shop name */

	$this->pageTitle = Yii::t('main', 'Orders') . ' - ' . Yii::t('main', Yii::app()->name);
?>
	<script>
		$(document).ready(function() {
			// enable link to tab
			var url = document.location.toString();
			if (url.match('#')) {
				$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
			}

			// Change hash for page-reload
			$('.nav-tabs a').on('shown', function (e) {
				window.location.hash = e.target.hash;
			})
		})
	</script>

	<h1>SHOP MODULE</h1>

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabNewOrders" data-toggle="tab"><?= Yii::t('orders', 'New'); ?></a></li>
			<li><a href="#tabWaitPaymentOrders" data-toggle="tab"><?= Yii::t('orders', 'Wait Payment'); ?></a></li>
			<li><a href="#tabProcessingOrders" data-toggle="tab"><?= Yii::t('orders', 'Processing'); ?></a></li>
			<li><a href="#tabInvalidOrders" data-toggle="tab"><?= Yii::t('orders', 'Invalid'); ?></a></li>
			<li><a href="#tabArchivedOrders" data-toggle="tab"><?= Yii::t('orders', 'Archived'); ?></a></li>
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
					'dataProvider' => $newProductsDataProvider,
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
						'price',
						array(
							'name' => 'created',
							//'type' => 'datetime',
							'value' => 'date("M j, Y", strtotime($data->created))',
						),
						'order_id',
						'user_id',
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
			<div class="tab-pane" id="tabWaitPaymentOrders">

<?php
				$form = $this->beginWidget('CActiveForm');
?>

<?php
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $waitPaymentProductsDataProvider,
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
						'price',
						array(
							'name' => 'created',
							//'type' => 'datetime',
							'value' => 'date("M j, Y", strtotime($data->created))',
						),
						'order_id',
						'user_id',
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
			<div class="tab-pane" id="tabProcessingOrders">
				<p>Processing Orders</p>
			</div>
			<div class="tab-pane" id="tabInvalidOrders">
				<p>Invalid Orders</p>
			</div>
			<div class="tab-pane" id="tabArchivedOrders">
				<p>Archived Orders</p>
			</div>
		</div>
	</div>
