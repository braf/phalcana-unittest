<?php 

error_reporting(E_ALL);
define('DOCROOT', realpath(__DIR__.'../../..').DIRECTORY_SEPARATOR);
define('APPPATH', realpath(DOCROOT.'app').DIRECTORY_SEPARATOR);
define('MODPATH', realpath(DOCROOT.'modules').DIRECTORY_SEPARATOR);
define('SYSPATH', realpath(DOCROOT.'system').DIRECTORY_SEPARATOR);

// Include the core framework files
require_once SYSPATH.'classes/Core/Phalcana.php';
require_once SYSPATH.'classes/Core/Filesystem.php';

// Initialize the framework
$app = new Phalcana();


// Instead of loading the main function for the app add the unit test module
$app->fs->setModules(array('unittest' => MODPATH.'unittest/') + $app->fs->getModules());

// Fix issue with PHPUnit serialization of globals
unset($app);