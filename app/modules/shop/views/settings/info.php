<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Info'); ?></a></li>
		<li><a href="<?= $this->createUrl('settings/currency'); ?>"><?= Yii::t('ShopModule.money', 'Rates'); ?></a></li>
	</ul>
	<div class="tab-content">

		<div class="tab-pane active" id="tabPersonalInfo">


			<div class="form">
				<?php $form = $this->beginWidget('CActiveForm'); ?>

				<?php echo $form->errorSummary($user); ?>

				<div id="rows">

					<div class="span6 well">

						<div class="row-fluid">

							<div class="span8">
								<?= Yii::t('main', 'Settings'); ?>
							</div>
							<div class="clear"></div>

							<div class="span8">
								<label><?= Yii::t('settings', 'Login'); ?></label>
								<input type="text" name="username" class="span12" placeholder=""
								       value="<?= $user->username; ?>">
							</div>

							<div class="span8">
								<label><?= Yii::t('settings', 'Firstname'); ?></label>
								<input type="text" name="firstname" class="span12" placeholder=""
								       value="<?= $user->firstname; ?>">
							</div>

							<div class="span8">
								<label><?= Yii::t('settings', 'Lastname'); ?></label>
								<input type="text" name="lastname" class="span12" placeholder=""
								       value="<?= $user->lastname; ?>">
							</div>

							<div class="span8">
								<label><?= Yii::t('settings', 'Email'); ?></label>
								<input type="text" name="email" class="span12" placeholder=""
								       value="<?= $user->email; ?>" readonly>
							</div>

							<div class="span8">
								<label><?= Yii::t('settings', 'Shopname'); ?></label>
								<input type="text" name="shopname" class="span12" placeholder=""
								       value="<?= $shopName; ?>" readonly>
							</div>
						</div>

					</div>

				</div>

				<div class="clear"></div>

				<div class="span9">
					<?php //echo CHtml::submitButton('Save'); ?>
					<input type="submit" name="submit" class="btn btn-primary"
					       value="<?= Yii::t('settings', 'Save'); ?>"/>
				</div>

				<?php $this->endWidget(); ?>
			</div>
			<!-- form -->
		</div>
	</div>
</div>