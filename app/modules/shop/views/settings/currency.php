<div class="tabbable">
	<ul class="nav nav-tabs">
		<li><a href="<?= $this->createUrl('settings/info'); ?>"><?= Yii::t('ShopModule.money', 'Info'); ?></a></li>
		<li class="active"><a href=""><?= Yii::t('ShopModule.money', 'Rates'); ?></a></li>

	</ul>
	<div class="tab-content">

		<div class="tab-pane active" id="tabCurrencyRates">

			<div class="form">
				<?php echo CHtml::beginForm(); ?>

				<?php //echo CHtml::errorSummary($model); ?>

				<div id="rows">
					<div class="span6 well">
						<div class="row-fluid">
							<div class="span8" style="margin-left: 0;">
								<P><?= Yii::t('money', 'Currency rates'); ?></P>

								<p><?= Yii::t('money', 'Your base currency is '); ?><?= $shopCurrencyName; ?></p>
							</div>
							<?php foreach ($actualCurrencies as $row) : ?>
								<div class="span8" style="margin-left: 0;">
									<span style="width: 10%;"><?= $row['name']; ?></span>

									<input type="text" name="currency[<?= $row['id']; ?>]" class="span3"
									       placeholder="NUMBER" value="<?= $row['currency_rate']; ?>">
								</div>

								<div class="clear"></div>
							<?php endforeach; ?>

							<?php   if (!empty($availableCurrencies)) : ?>

								<p><?= Yii::t('money', 'Add currency'); ?></p>


								<select class="span7" name="new_currency_id">
									<option disabled selected><?= Yii::t('money', 'Choose currency'); ?></option>
									<?php foreach ($availableCurrencies as $row) : ?>
										<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
									<?php endforeach; ?>
								</select>
								<input type="text" class="span3" placeholder="NUMBER" name="new_currency_rate" value="">

							<?php endif; ?>

						</div>
					</div>
				</div>

				<div class="row submit">
					<input type="submit" name="submit" class="btn btn-primary" value="<?= Yii::t('money', 'Save'); ?>">
				</div>




				<?php echo CHtml::endForm(); ?>
			</div>
			<!-- form -->

		</div>
	</div>
</div>