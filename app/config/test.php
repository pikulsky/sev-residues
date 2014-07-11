<?php

// these settings are merged to main.php config file

return array(

	'components'=>array(

		'fixture'=>array(
			'class'=>'system.test.CDbFixtureManager',
		),
		'db' => array(
			'class' => 'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=res_test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
	),
);
