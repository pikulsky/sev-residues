<?php
/* @var $this RegisterController */
/* @var registerSellerForm LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::t('register', 'Registration for seller') . ' - ' . Yii::t('main', Yii::app()->name);
?>

<div class="span10">
	<div class="row-fluid">
		<h1><?= Yii::t('register', 'Registration for seller'); ?></h1>
		<div class="span4 offset3">

			<div class="form">
				<?php
					$form = $this->beginWidget('CActiveForm', array(
						'id' => 'register-form',
						'enableClientValidation' => true,
						'clientOptions' => array(
							'validateOnSubmit' => true,
						),
					));
				?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<div class="row">
					<?php echo $form->labelEx($registerSellerForm, 'username'); ?>
					<?php echo $form->textField($registerSellerForm, 'username'); ?>
					<?php echo $form->error($registerSellerForm, 'username'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($registerSellerForm, 'password'); ?>
					<?php echo $form->passwordField($registerSellerForm, 'password'); ?>
					<?php echo $form->error($registerSellerForm, 'password'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($registerSellerForm, 'email'); ?>
					<?php echo $form->textField($registerSellerForm, 'email'); ?>
					<?php echo $form->error($registerSellerForm, 'email'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($registerSellerForm, 'shopname'); ?>
					<?php echo $form->textField($registerSellerForm, 'shopname'); ?>
					<?php echo $form->error($registerSellerForm, 'shopname'); ?>
				</div>

				<div class="row buttons">
					<?php echo CHtml::submitButton(Yii::t('register', 'Register')); ?>
				</div>

			<?php $this->endWidget(); ?>
			</div><!-- form -->

		</div><!--/span-->
	</div><!--/row-->	
</div>
