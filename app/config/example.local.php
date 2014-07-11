<?php

// copy this file to local.php and modify your local settings

// set debug/production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// set trace level, default is 3
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

return array(

	// application components
	'components'=>array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=teambuy',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
	),

);