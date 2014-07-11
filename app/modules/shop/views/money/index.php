<?php
	/* @var $this MoneyController */

	$this->pageTitle = Yii::t('ShopModule.money', 'Money') . ' - ' . Yii::t('main', Yii::app()->name);
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

	<div class="tabbable">
		<ul class="nav nav-tabs">
<!-- "bank" is disabled for now
			<li><a href="#tabBank" data-toggle="tab"><?= Yii::t('ShopModule.money', 'Bank'); ?></a></li>
-->
			<li class="active"><a href="#tabInvoices" data-toggle="tab"><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>

<!-- "cash" is disabled for now
			<li><a href="#tabCash" data-toggle="tab"><?= Yii::t('ShopModule.money', 'Cash'); ?></a></li>
-->
			<li><a href="#tabBalance" data-toggle="tab"><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
			<li><a href="#tabTransaction" data-toggle="tab"><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
		</ul>
		<div class="tab-content">
<!-- "bank" is disabled for now
			<div class="tab-pane active" id="tabBank">

<?php
				$form = $this->beginWidget('CActiveForm');
?>

<?php
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $paymentsDataProvider,
					// ? 'filter' => $model, note: if filter is used, then add hidden Filter button
					// as a first submit button to catch ENTER hit from user

					// 'type' for TbJsonGridView
					//'type' => 'striped bordered condensed',

					// 'summaryText' => false,
					// 'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
					// 'cacheTTLType' => 's', // type can be of seconds, minutes or hours
					
					'columns' => array(
						array(
							'id' => 'checkboxPaymentId',
							'class' => 'CCheckBoxColumn',
							'selectableRows' => 20, // TODO from param: rows per page
						),						
						'id',
						array(
							'name' => 'created',
							//'type' => 'datetime',
							'value' => 'date("M j, Y", strtotime($data->created))',
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
				echo CHtml::submitButton(Yii::t('ShopModule.money', 'Confirm payment'), array(
					'name' => 'confirmPayment',
				));
?>
				
<?php
				$this->endWidget();
?>				
			</div>
-->

			<div class="tab-pane active" id="tabInvoices">
<?php
				$form = $this->beginWidget('CActiveForm');
?>
<?php
				//$this->widget('bootstrap.widgets.TbJsonGridView', array(
				$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider' => $invoicesDataProvider,
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
						'amount',
						'buyer_id',
						array(
							'name' => 'invoice_status_id',
							'type' => 'raw',
							'value' => '$data->getStatus($data->invoice_status_id)'
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
			</div>
<!--
			<div class="tab-pane" id="tabCash">
				<p><?= Yii::t('ShopModule.money', 'Cash'); ?></p>
			</div>
-->
			<!-- /tabCash -->

			<div class="tab-pane" id="tabBalance">
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
			
			<div class="tab-pane" id="tabTransaction">
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
						'transactionAmount:raw:'. Yii::t('payments', 'Transaction Amount'),
						'currencyName:raw:'. Yii::t('payments', 'Currency Name'),
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
