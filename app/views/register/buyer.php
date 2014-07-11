<?php
/* @var $this RegisterController */
/* @var registerBuyerForm LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::t('register', 'Registration for buyer') . ' - ' . Yii::t('main', Yii::app()->name);
?>

<div class="span10">
	<div class="row-fluid">
		<h1><?= Yii::t('register', 'Registration for buyer'); ?></h1>

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
					<?php echo $form->labelEx($registerBuyerForm, 'username'); ?>
					<?php echo $form->textField($registerBuyerForm, 'username'); ?>
					<?php echo $form->error($registerBuyerForm, 'username'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($registerBuyerForm, 'password'); ?>
					<?php echo $form->passwordField($registerBuyerForm, 'password'); ?>
					<?php echo $form->error($registerBuyerForm, 'password'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($registerBuyerForm, 'email'); ?>
					<?php echo $form->textField($registerBuyerForm, 'email'); ?>
					<?php echo $form->error($registerBuyerForm, 'email'); ?>
				</div>

				<div class="row buttons">
					<?php echo CHtml::submitButton(Yii::t('register', 'Register')); ?>
				</div>

			<?php $this->endWidget(); ?>
			</div><!-- form -->

		</div><!--/span-->
	</div><!--/row-->	
</div>
