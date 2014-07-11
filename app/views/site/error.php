<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::t('main', 'Error') . ' - ' . Yii::t('main', Yii::app()->name);
$this->breadcrumbs = array(
	 Yii::t('main', 'Error'),
);
?>

<h2><?= Yii::t('main', 'Error'); ?> <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>