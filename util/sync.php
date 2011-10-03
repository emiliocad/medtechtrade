<?php

$projectPath = realpath(__DIR__ . '/../trunk/src');
//$projectPath = 'E:\Project\Zend\medtechtrade.zend.local\trunk\src';
$configPath = $projectPath . "/application/configs/application.ini";
$libraryPath = $projectPath . "/library/";
$deltaPath = $projectPath . "/sql/";
$logPath = $projectPath . "/logs/sync.txt";
$env = "development";
define ("APPLICATION_ENV", $env);
date_default_timezone_set('America/Lima');

$paths = array($libraryPath, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $paths));

require 'Zend/Loader/Autoloader.php';

$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace('Mtt_');

$config = new Zend_Config_Ini($configPath, $env);
$db = Zend_Db::factory($config->resources->db);
$log = new Zend_Log(new Zend_Log_Writer_Stream($logPath));
$mmm = new Mtt_Migration_Manager($db, $deltaPath, $log);
$mmm->sync();
