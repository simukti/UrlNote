<?php
return array (
    'phpSettings' => array (
        'memory_limit'      => '192M',
        'error_reporting'   => true,
        'display_errors'    => true,
        'display_startup_errors' => true,
    ),
    'includePaths' => array(
        'simukti' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'library',
    ),
    'bootstrap' => array (
        'path'  => APPLICATION_PATH . DIRECTORY_SEPARATOR .'Bootstrap.php',
        'class' => 'Bootstrap',
    ),
    'autoloaderNamespaces' => array(
        'Simukti'
    ),
    'resources'  => array (
        'frontController' => array (
            'throwErrors'     => true,
            'params'          => array (
                'throwExceptions' => true,
                'displayExceptions' => true,
            ),
            'controllerDirectory' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'controllers',
            'params' => array(
                'disableOutputBuffering' => true,
            ),
        ),
        'cachemanager' => include_once __DIR__ . DIRECTORY_SEPARATOR . 'cache.php',
        'router' => array ('routes'  => include_once __DIR__ . DIRECTORY_SEPARATOR . 'routes.php'),
        'navigation' => include_once __DIR__ . DIRECTORY_SEPARATOR . 'nav.php',
        'locale' => array (
            'default'   => 'id_ID',
            'force'     => true
        ),
        'layout' => array (
            'layoutPath'  => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts',
            'layout'      => '_layout',
        ),
        'db' => include_once __DIR__ . DIRECTORY_SEPARATOR . 'db.php',
        'view' => array (
            'doctype'     => 'HTML5',
            'encoding'    => 'utf8',
            'contentType' => 'text/html; charset=utf-8',
            'helperPath' => array(
                'View_Helper' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'helpers',
            ),
        ),
    )
);