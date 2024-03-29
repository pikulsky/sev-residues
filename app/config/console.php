<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'My Console Application',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),
	
	// configuration for console commands
	'commandMap' => array(

		// configuration for "migrate" command
		'migrate' => array(
			'class' => 'system.cli.commands.MigrateCommand',
			'migrationTable' => 'migration',
		),
	),

	// application components
	'components' => array(
		//'db'=>array(
		//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		//),
		// uncomment the following to use a MySQL database
		//'db' => array(
		//	'connectionString' => 'mysql:host=localhost;dbname=teambuy',
		//	'emulatePrepare' => true,
		//	'username' => 'root',
		//	'password' => '',
		//	'charset' => 'utf8',
		//),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);