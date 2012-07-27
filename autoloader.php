<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(__DIR__ . DIRECTORY_SEPARATOR . 'application'));
defined('APPLICATION_ENV')  || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

if (file_exists('vendor/autoload.php')) {
    $loader = require_once 'vendor/autoload.php';
    if(!class_exists('Zend_Loader_Autoloader')) {
        throw new \RuntimeException('Unable to load zend framework autoloader. Run `php composer.phar install` to install required library.');
    }
} else {
    throw new \Exception('Run `php composer.phar install` to install required library.');
}
if(isset($loader)) {
    $application = new \Zend_Application(APPLICATION_ENV, include_once APPLICATION_PATH . '/configs/application.php');
    $application->bootstrap()->run();
}