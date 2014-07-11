<div class="tabbable">
	<ul class="nav nav-tabs">
		<li><a href="<?= $this->createUrl('money/invoices'); ?>"><?= Yii::t('ShopModule.money', 'Invoices'); ?></a></li>
		<li><a href="<?= $this->createUrl('money/balances'); ?>"><?= Yii::t('ShopModule.money', 'Balance'); ?></a></li>
		<li><a href="<?= $this->createUrl('money/transactions'); ?>"><?= Yii::t('ShopModule.money', 'Transaction'); ?></a></li>
		<li><a href="<?= $this->createUrl('money/archive'); ?>"><?= Yii::t('ShopModule.money', 'Archive'); ?></a></li>
	</ul>
	<div class="tab-content">
	<div class="tab-pane active">

	<div class="form">

	<h3><?= Yii::t('money', 'Add money to buyer balance'); ?></h3>

<?php $form = $this->beginWidget('CActiveForm'); ?>

	<input type="hidden" name="product_status_id" value="0" />
	
	<?php /*
	 * http://www.yiiframework.com/doc/guide/1.1/ru/form.table
	 * http://bootsnipp.com/tags/forms
	 * http://bootsnipp.com/snipps/loginregister-in-tabbed-interface
	 * http://bootsnipp.com/snipps/credit-card-payment-form-2
	 * http://limcheekin.blogspot.com/2012/08/twitter-bootstrap-multiple-columns-form.html
	 * http://www.w3resource.com/twitter-bootstrap/forms-tutorial.php
	 *
	 */
	?>

	<?php echo $form->errorSummary($model); ?>

	<!-- <div class="row-fluid">
		<div class="span12 bgcolor">
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">×</a>
				Error Messages.
			</div>
		</div>
	</div> -->
		
	<div id="rows">

		<div class="span9 well">

		<div class="span8">
			<div class="row-fluid">
				<div class="span6">
					<label><?= Yii::t('transactions', 'For whom'); ?></label>
					<select name="user_id" class="span12Xdd">

<?php foreach ($usersForSellerList as $row) {   ?>
						<option value="<?= $row['userId']; ?>"><?= $row['userFirstname']; ?> <?= $row['userLastname']; ?></option>
<?php } ?>

					</select>
				</div>
			</div><!--/row-->

			<div class="row-fluid">
				<div class="span2">
					<label><?= Yii::t('transactions', 'Amount'); ?></label>
					<input type="text" name="amount" class="span12ssX" placeholder="">
				</div>
				<div class="span2" style="width: auto;">
					<label><?= Yii::t('transactions', 'Currency'); ?></label>
					<select name="currency_id" class="span12Xdd">
						
<?php foreach ($currencyList as $row) {   ?>	
					<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
<?php } ?>
	
					</select>
				</div>
			</div><!--/row-->

			<div class="row-fluid">
				<div class="span7">
					<label><?= Yii::t('transactions', 'Comment'); ?></label>
					<input type="text" name="comment" class="span12" placeholder="">
				</div>
				<!--
				<div class="span2">
					<a class="btn btn-success add-product"><i class="icon-plus icon-white"></i> <?= Yii::t('orders', 'More'); ?></a>
				</div>
				<div class="span2">
					<a class="btn btn-danger remove-product"><i class="icon-minus icon-white"></i> <?= Yii::t('orders', 'Remove'); ?></a>
				</div>
				-->
			</div><!--/row-->

		</div>
		</div>
	</div><!-- /rows -->
	
	<div class="clear" ></div>
	
    <div class="span9">
		<input type="submit" name="submit" class="btn btn-primary" value="<?= Yii::t('money', 'Save'); ?>"/>
    </div>

<?php $this->endWidget(); ?>
	</div><!-- form -->

	</div><!-- /tabBalance -->
	</div> <!-- /tab-content -->
</div> <!-- /tabbable -->
