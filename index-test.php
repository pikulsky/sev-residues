<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii = dirname(__FILE__).'/framework/yii.php';
// note: test.php includes main.php
$basePath = dirname(__FILE__).'/app/config/test.php';
$localPath = dirname(__FILE__).'/app/config/test.local.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);

// build config from main and local configs
$config = require($basePath);
if (file_exists($localPath)) {
	$localConfig = require($localPath);
	$config = CMap::mergeArray($config, $localConfig);
}

Yii::createWebApplication($config)->run();
