<?php

// attach debugbar
require_once(dirname(__FILE__).'/app/config/debugbar.php');

$yii = dirname(__FILE__).'/framework/yii.php';
$basePath = dirname(__FILE__).'/app/config/main.php';
$localPath = dirname(__FILE__).'/app/config/local.php';

// load local config
$localConfig = array();
if (file_exists($localPath)) {
	$localConfig = require($localPath);
}

// if debug/production mode was not set in local config
// then set debug mode by default
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);

// build config from main and local configs
$config = require($basePath);
if (!empty($localConfig)) {
	$config = CMap::mergeArray($config, $localConfig);
}

Yii::createWebApplication($config);

$runner = new CConsoleCommandRunner();
$runner->commands = array(
	'migrate' => array(
		'class' => 'system.cli.commands.MigrateCommand',
		'migrationTable' => 'migration',
		'interactive' => false,
	),
);

echo '<pre>';
ob_start();

set_time_limit(0);

$runner->run(array(
	'yiic',
	'migrate',
));
echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
echo '</pre>';
