<?php

return array(
	'buyer' => array(
		'id' => 1,
		'user_role_id' => UserRole::USER_ROLE_BUYER,
		'username' => 'buyer',
		'password' => '',
		'salt' => '',
		'login_ip' => '',
		'login_attempts' => 0,
		'validation_key' => '',
		'password_strategy' => '',
		'requires_new_password' => 0,
		'status' => 0,
	),
	'seller' => array(
		'id' => 2,
		'user_role_id' => UserRole::USER_ROLE_SELLER,
		'username' => 'seller',
		'shop_id' => 1, // see shop.php fixture
		'password' => '',
		'salt' => '',
		'login_ip' => '',
		'login_attempts' => 0,
		'validation_key' => '',
		'password_strategy' => '',
		'requires_new_password' => 0,
		'status' => 0,
	),
	'buyer1' => array(
		'id' => 3,
		'user_role_id' => UserRole::USER_ROLE_BUYER,
		'username' => 'buyer2',
		'password' => '',
		'salt' => '',
		'login_ip' => '',
		'login_attempts' => 0,
		'validation_key' => '',
		'password_strategy' => '',
		'requires_new_password' => 0,
		'status' => 0,
	),
);
