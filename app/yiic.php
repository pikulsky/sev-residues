<?php

// change the following paths if necessary
$yiic = dirname(__FILE__).'/../framework/yiic.php';

$basePath = dirname(__FILE__).'/config/console.php';
$localPath = dirname(__FILE__).'/config/local.php';

// to load CMap:
require_once(dirname(__FILE__).'/../framework/yii.php');

// build config from main and local configs
$config = require($basePath);
if (file_exists($localPath)) {
	$localConfig = require($localPath);
	$config = CMap::mergeArray($config, $localConfig);
}

require_once($yiic);