<?php

class SettingsController extends BuyerController
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$user = User::model()->getCurrentUser();

		if(!empty($_POST)) {

			$user->attributes = $_POST;

			if ($user->validate()) {
				if ($user->save()) {
					$this->redirect(array('settings/index'));
				} else {
					// failed to save product
					// TODO: show error
				}
			} else {
				// validation error
			}
		}
		$this->render('index', array(
			'user' => $user,
		));
	}

}

