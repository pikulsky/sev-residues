<?php

/**
 * Common operations for seller controllers
 */
class ShopController extends Controller
{

	/**
	 * Checks:
	 * - if user is not logged in, then redirect to login/register page
	 * - if user is not seller, then redirect to home page
	 */
	public function init()
	{
		// guests are redirected to login page
		if (Yii::app()->user->isGuest) {
			// note the leading "/" in URL:
			// controller is used in modules
			$this->redirect(array('/login/index')); 
		}

		if (!User::model()->isCurrentUserSeller()) {
			$this->redirect(array('/site/')); 
		}

		parent::init();
	}

}