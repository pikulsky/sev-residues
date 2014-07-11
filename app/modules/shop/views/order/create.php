<script>
	function recountRows() {
		$.each($(".product-number"), function(index, value){
			$(value).html("<span>" + (1+index) + ")</span>");
		});
	}
	
	$(document).ready(function(){
		
		if ($(".product-row").length == 1) {
			$(".remove-product").hide();
		}
		
		// handler for "more" button:
		// 1) add a new sectin below the current
		// 2) show "remove" button
		$(".add-product").on("click", function() {
			//
			var parentRow = $(this).closest(".product-row");
			var newSection = parentRow.clone(true);
			newSection.hide();
			newSection.insertAfter(parentRow).show("fast");
			//
			$(".remove-product").show();
			//
			recountRows();
		});

		// handler for "remove" button
		//
		$(".remove-product").on("click", function() {
			var row = $(this).closest(".product-row");
			row.remove();
			//
			if ($(".product-row").length == 1) {
				$(".remove-product").hide();
			}
			//
			recountRows();
		});
	})
</script>

<h1><?= $shopname; ?></h1>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>

	<input type="hidden" name="product_status_id" value="0" />
	
	<legend><?= Yii::t('orders', 'New order'); ?></legend>

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
	<?php for ($i = 1; $i <= 1; $i++): ?>

		<div class="product-row span9 well">
		<div class="product-number">
			<span><?= $i; ?>)</span>
		</div>

		<div class="span8">
			<div class="row-fluid">
				<div class="span6">
					<label><?= Yii::t('orders', 'URL'); ?></label>
					<input type="text" name="url" class="span12" placeholder="">
				</div>
				<div class="span4">
					<label><?= Yii::t('orders', 'Title'); ?></label>
					<input type="text" name="title" class="span12" placeholder="">
				</div>
				<div class="span2 lightblue">
					<label><?= Yii::t('orders', 'SKU'); ?></label>
					<input type="text" name="sku" class="span12" placeholder="">
				</div>
			</div><!--/row-->

			<div class="row-fluid">
				<div class="span3">
					<label><?= Yii::t('orders', 'Color'); ?></label>
					<input type="text" name="color" class="span12" placeholder="">
				</div>
				<div class="span2">
					<label><?= Yii::t('orders', 'Size'); ?></label>
					<input type="text" name="size" class="span12" placeholder="">
				</div>
				<div class="span2">
					<label><?= Yii::t('orders', 'Price'); ?></label>
					<input type="text" name="price" class="span12ssX" placeholder="">
				</div>
				<div class="span2" style="width: auto;">
					<label><?= Yii::t('orders', 'Currency'); ?></label>
					<select name="currency" class="span12Xdd">
<?php foreach ($currencyList as $row) { ?>	
						<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
<?php } ?>
					</select>
				</div>
				<div class="span1">
					<label><?= Yii::t('orders', 'Quantity'); ?></label>
					<input type="text" name="quantity" class="span12" placeholder="" value="1">
				</div>
			</div><!--/row-->

			<div class="row-fluid">
				<div class="span7">
					<label><?= Yii::t('orders', 'Comment'); ?></label>
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

	<?php endfor; ?>
	</div><!-- /rows -->
	
	<div class="clear" ></div>
	
    <div class="span9">
		<?php //echo CHtml::submitButton('Save'); ?>
		<input type="submit" name="submit" class="btn btn-primary" value="<?= Yii::t('orders', 'Send'); ?>"/>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->