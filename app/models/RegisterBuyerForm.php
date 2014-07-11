<?php

/**
 * RegisterBuyerForm class
 */
class RegisterBuyerForm extends CFormModel
{
	public $username;
	public $password;
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, email', 'required'),
			// TODO valid email
			// array('email', ''),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username' => Yii::t('login', 'Username'),
			'password' => Yii::t('login', 'Password'),
			'email' => Yii::t('register', 'Email'),
		);
	}

	/**
	 * Registers user using the given data.
	 * @return boolean whether registration is successful
	 */
	public function register()
	{
		$result = false;

		// create buyer
		$buyer = User::model()->createBuyer($this);

		if ($buyer && !$buyer->hasErrors()) {

			$loginForm = new LoginForm();

			$loginForm->username = $this->username;
			$loginForm->password = $this->password;

			// validate user input and login user
			$result = $loginForm->validate() && $loginForm->login();
		}

		// TODO in case of error - return errors from model ?
		return $result;
	}
}
