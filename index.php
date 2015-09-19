<?php

error_reporting(E_ALL);
define('DOCROOT', realpath(__DIR__.DIRECTORY_SEPARATOR.'../..').DIRECTORY_SEPARATOR);
define('APPPATH', realpath(DOCROOT.'app').DIRECTORY_SEPARATOR);
define('MODPATH', realpath(DOCROOT.'modules').DIRECTORY_SEPARATOR);
define('SYSPATH', realpath(DOCROOT.'system').DIRECTORY_SEPARATOR);


// Include the core framework files
require_once SYSPATH.'classes/Phalcana.php';
require_once SYSPATH.'classes/Core/Filesystem.php';
require_once DOCROOT.'vendor/autoload.php';

// Initialize the framework
$app = new Phalcana\Phalcana();

$modules = array('unittest' => MODPATH.'unittest/');

if (Phalcana\Phalcana::$mode == Phalcana\Phalcana::TESTING) {
    // Check for module environment
    if ($module = getenv('phalacana_module')) {
        $modules[$module] = MODPATH.$module.'/';
    }
    unset($module);
}

// Instead of loading the main function for the app add the unit test module
$app->fs->setModules($modules + $app->fs->getModules());

// Fix issue with PHPUnit serialization of globals
unset($app, $modules);
