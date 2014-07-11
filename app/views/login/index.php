<?php
/* @var $this LoginController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::t('login','Login') . ' - ' . Yii::t('main', Yii::app()->name);
?>

<div class="span10">
	<div class="row-fluid">
		<div class="span4 offset3">
			<h1><?= Yii::t('login','Login'); ?></h1>

			<div class="form">
			<?php
				$form = $this->beginWidget('CActiveForm', array(
					'id' => 'login-form',
					'enableClientValidation' => true,
					'clientOptions' => array(
						'validateOnSubmit' => true,
					),
				));
			?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<div class="row">
					<?php echo $form->labelEx($model, 'username'); ?>
					<?php echo $form->textField($model, 'username'); ?>
					<?php echo $form->error($model, 'username'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model, 'password'); ?>
					<?php echo $form->passwordField($model, 'password'); ?>
					<?php echo $form->error($model, 'password'); ?>
				</div>

				<div class="row rememberMe">
					<?php echo $form->checkBox($model, 'rememberMe'); ?>
					<?php echo $form->label($model, 'rememberMe'); ?>
					<?php echo $form->error($model, 'rememberMe'); ?>
				</div>

				<div class="row buttons">
					<?php echo CHtml::submitButton(Yii::t('login','Login')); ?>
				</div>

			<?php $this->endWidget(); ?>
			</div><!-- form -->

		</div><!--/span-->
		<div class="span4">
			<h1><?= Yii::t('login', 'Registration'); ?></h1>
			<ul>
				<li><?= CHtml::link(Yii::t('login', 'For sellers'), array('register/seller')); ?></li>
				<li><?= CHtml::link(Yii::t('login', 'For buyers'), array('register/buyer')); ?></li>
			</ul>
		</div><!--/span-->
	</div><!--/row-->	
</div>
