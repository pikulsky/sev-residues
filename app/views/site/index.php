<?php
/* @var $this SiteController */

	$this->pageTitle = Yii::t('main', Yii::app()->name);
?>

<div class="span10">
	<div class="row-fluid">
		<div class="span3">
			<?php
				$this->beginWidget('bootstrap.widgets.TbBox', array(
					'title' => 'Что нового',
					'headerIcon' => 'icon-calendar',
					// 'content' => $news, // $this->renderPartial('_view')
				));
			?>
			<ul>
<!--				<li>
					<?php $shopname = 'pika'; ?>
					<a href="<?= $this->createUrl('order/new', array('shopname' => $shopname)); ?>"><?= $shopname; ?></a>
				</li>
				<li>
					<?php $shopname = 'koko'; ?>
					<a href="<?= $this->createUrl('order/new', array('shopname' => $shopname)); ?>"><?= $shopname; ?></a>
				</li>
				<li>
					<?php $shopname = 'pika2'; ?>
					<a href="<?= $this->createUrl('order/new', array('shopname' => $shopname)); ?>"><?= $shopname; ?></a>
				</li>-->
				<li>заказы - 5шт.</li>
				<li>закупки - 1шт.</li>
				<li>оплата - 5шт.</li>
			</ul>
			<?php $this->endWidget();?>
		</div><!--/span-->
		<div class="span4">
			<?php
				$messages = 'нет новых сообщений';
				$this->widget('bootstrap.widgets.TbBox', array(
					'title' => 'Сообщения',
					'headerIcon' => 'icon-envelope',
					'content' => $messages, // $this->renderPartial('_view')
				));
			?>
		</div><!--/span-->
		<div class="span5">
			<?php
				$this->beginWidget('bootstrap.widgets.TbBox', array(
					'title' => 'Оплаты',
					'headerIcon' => 'icon-align-center',
					//'content' => $payments, // $this->renderPartial('_view')
				));
			?>
			<ul>
				<li>Irina - 340грн (14.05.2013 14:12).</li>
				<li>Snow - 155грн (14.05.2013 14:10).</li>
				<li>Elena - 785грн. (14.05.2013 09:01)</li>
				<li>Ks80 - 510грн. (13.05.2013 23:30)</li>
				<li>Natalia - 510грн. (13.05.2013 20:22)</li>
			</ul>
			<?php $this->endWidget();?>
		</div><!--/span-->
	</div><!--/row-->	
</div>
