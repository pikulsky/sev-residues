<?php
	/* @var $this SettingsController */

	$this->pageTitle = Yii::t('main', 'Settings') . ' - ' . Yii::t('main', Yii::app()->name);
?>

	<h1><?= Yii::t('main', 'Settings'); ?></h1>
	
		<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>


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
		
	<div id="rows">

		<div class="settings span9 well">

		<div class="span8">
			<div class="row-fluid">
				<div class="span6">
					<label><?= Yii::t('settings', 'Login'); ?></label>
					<input type="text" name="username" class="span12" placeholder="" value="<?= $user->username; ?>">
				</div>
				<div class="span6">
					<label><?= Yii::t('settings', 'Firstname'); ?></label>
					<input type="text" name="firstname" class="span12" placeholder="" value="<?= $user->firstname; ?>">
				</div>
				<div class="span6">
					<label><?= Yii::t('settings', 'Lastname'); ?></label>
					<input type="text" name="lastname" class="span12" placeholder="" value="<?= $user->lastname; ?>">
				</div>
				<div class="span6">
					<label><?= Yii::t('settings', 'Email'); ?></label>
					<input type="text" name="email" class="span12" placeholder="" value="<?= $user->email; ?>" readonly>
				</div>
			</div>

		</div>
		</div>

	</div>
	
	<div class="clear" ></div>
	
    <div class="span9">
		<?php //echo CHtml::submitButton('Save'); ?>
		<input type="submit" name="submit" class="btn btn-primary" value="<?= Yii::t('settings', 'Save'); ?>"/>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->