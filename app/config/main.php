<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

function _joinpath($dir1, $dir2) {
    return realpath($dir1 . DIRECTORY_SEPARATOR . $dir2);
}
 
$homePath      = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
$runtimePath   = _joinpath($homePath, 'runtime');

return array(
	'basePath' => $homePath,
	'runtimePath' => $runtimePath,

	'name' => 'SP',

	// not used for now
	//'defaultController' => 'site',
 
	'language' => 'ru',

	// preloading components
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.shop.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'sp',
			'generatorPaths' => array(
				'application.gii',
			),			
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1','::1'),
		),
		// Shop module is for sellers
		'shop',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			// when authorization fails non-logged user is redirected here
			'loginUrl' => array('login/index'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				// gii
				'gii' => 'gii',
				'gii/<controller:\w+>' => 'gii/<controller>',
				'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
				// appication
				
				// check for shopname in url (shopname/order/create)
				array(
					'class' => 'application.components.ShopnameUrlRule',
				),
				'<controller:\w+>' => '<controller>/index',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=res',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true,
		),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				#...
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				array(
					'class' => 'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
					'enabled' => DEBUGBAR,
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);