<?php

class SettingsController extends ShopController
{


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// the default tab is "Info"
		$this->redirect(array('settings/info'));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionInfo()
	{
		$user = User::model()->getCurrentUser();
		$shopName = User::model()->getCurrentSellerShopName();

		if (!empty($_POST)) {

			$user->attributes = $_POST;

			if ($user->validate()) {
				if ($user->save()) {
					$this->redirect(array('settings/info'));
				} else {
					// failed to save product
					// TODO: show error
				}
			} else {
				// validation error
			}
		}
		$this->render('info', array(
			'user' => $user,
			'shopName' => $shopName,
		));
	}

	public function actionCurrency()
	{
		$currency = Currency::model();

		if (!empty($_POST)) {
			if (isset($_POST['currency'])) {
				foreach ($_POST['currency'] as $id => $rate) {
					$currency_rate = CurrencyRate::model()->findByPk($id);
					$currency_rate->currency_rate = $rate;
					$currency_rate->save();
				}
			}
			if (isset($_POST['new_currency_id'])) {

				$newCurrencyRateData = array(
					'shop_id' => User::model()->getCurrentSellerShopId(),
					'seller_id' => User::model()->getCurrentUserId(),
					'new_currency_rate' => $_POST['new_currency_rate'],
					'new_currency_id' => $_POST['new_currency_id'],
				);
				$currency->saveNewCurrencyRate($newCurrencyRateData);
			}
		}
		$shop_id = User::model()->getCurrentSellerShopId();


		$data = array(
			'shop_id' => User::model()->getCurrentSellerShopId(),
			'shop_base_currency_id' => $currency->getBaseCurrencyByShopId($shop_id)['base_currency_id'],
		);
		$this->render('currency', array(
			'shopCurrencyName' => $currency->getBaseCurrencyByShopId($shop_id)['name'],
			'availableCurrencies' => $currency->getAvailableCurrenciesByShopId($data),
			'actualCurrencies' => $currency->getActualCurrencyRates($shop_id),
		));
	}


}