<?php

class RegisterController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	/**
	 * Displays the login page
	 */
	public function actionIndex()
	{
		$this->redirect(array('site/index'));
	}

	public function actionBuyer()
	{
		$registerBuyerForm = new RegisterBuyerForm();

		// collect user input data
		if (isset($_POST['RegisterBuyerForm'])) {
			$registerBuyerForm->attributes = $_POST['RegisterBuyerForm'];

			// validate user input and register a user as buyer
			if($registerBuyerForm->validate() && $registerBuyerForm->register()) {
				// go to home page
				// TODO login ?
				$this->redirect(array('site/index'));
			}
		}
		// display the login form
		$this->render('buyer', array(
			'registerBuyerForm' => $registerBuyerForm,
		));
	}

	public function actionSeller()
	{
		$registerSellerForm = new RegisterSellerForm();

		// collect user input data
		if (isset($_POST['RegisterSellerForm'])) {
			$registerSellerForm->attributes = $_POST['RegisterSellerForm'];

			// validate user input and register a user as seller
			if($registerSellerForm->validate() && $registerSellerForm->register()) {
				// go to home page
				// TODO login ?
				$this->redirect(array('site/index'));
			}
		}
		// display the login form
		$this->render('seller', array(
			'registerSellerForm' => $registerSellerForm,
		));
	}

}