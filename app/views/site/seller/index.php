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
				
			</ul>
			<?php $this->endWidget();?>
		</div><!--/span-->
	</div><!--/row-->	
</div>
