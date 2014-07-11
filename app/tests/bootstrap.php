<?php
// attach debugbar
require_once(dirname(__FILE__).'/../config/debugbar.php');

// paths to Yii framework and configs
$yiit = dirname(__FILE__).'/../../framework/yiit.php';
$basePath = dirname(__FILE__).'/../config/main.php';
$testConfigPath = dirname(__FILE__).'/../config/test.php';

// load local config
$testConfig = array();
if (file_exists($testConfigPath)) {
	$testConfig = require($testConfigPath);
}

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

// build config from main and local configs
$config = require($basePath);
if (!empty($testConfig)) {
	$config = CMap::mergeArray($config, $testConfig);
}

Yii::createWebApplication($config);

// migrating test database
$runner = new CConsoleCommandRunner();
$runner->commands = array(
	'migrate' => array(
		'class' => 'system.cli.commands.MigrateCommand',
		'migrationTable' => 'migration',
		'interactive' => false,
	),
);
$runner->run(array(
	'yiic',
	'migrate',
	'--connectionID=db',
));
