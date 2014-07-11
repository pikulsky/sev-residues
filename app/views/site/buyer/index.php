<?php
/* @var $this SiteController */

	$this->pageTitle = Yii::t('main', Yii::app()->name);
?>

<div class="span10">
	<div class="row-fluid">
		<div class="span5">
			<?php
				$this->beginWidget('bootstrap.widgets.TbBox', array(
					'title' => 'Магазины',
					'headerIcon' => 'icon-calendar',
					// 'content' => $news, // $this->renderPartial('_view')
				));
			?>
			<h4>Добавить заказ в магазин:</h4>
			<ul>
				<?php foreach ($shopNames as $shopName) { ?>
				<li><a href="<?= $this->createUrl('order/create',
						array('shopname' => $shopName['name'])); ?>"><?= $shopName['name']; ?></a></li>
				
				<?php } ?>
			</ul>
			<?php $this->endWidget();?>
		</div><!--/span-->
	</div><!--/row-->	
</div>
