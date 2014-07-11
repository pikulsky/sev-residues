<?php

/**
 * Common operations for buyer controllers
 */
class BuyerController extends Controller
{

	/**
	 * Checks:
	 * - if user is not logged in, then redirect to login/register page
	 */
	public function init()
	{
		// guests are redirected to login page
		if (Yii::app()->user->isGuest) {
			// note the leading "/" in URL:
			// controller is used in modules
			$this->redirect(array('/login/index')); 
		}

		parent::init();
	}

}