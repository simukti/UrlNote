<?php
/**
 * /add
 * /tags
 * /tag/999
 */
return array(
    'default' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => '/:page',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'index',
            'page'       => 1
        ),
        'reqs' => array(
            'page' => '\d+'
        )
    ),
    'add' => array(
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => '/add',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'add',
        ),
    ),
    'tags' => array(
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => '/tags',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'tags',
        ),
    ),
    'tag' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => '/tag/:slug/:page',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'tag',
            'page'       => 1
        ),
        'reqs' => array(
            'slug' => '([a-zA-Z0-9\-_]+)',
            'page' => '\d+'
        )
    ),
    'edit' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => '/edit/:id',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'edit'
        ),
        'reqs' => array(
            'id' => '\d+'
        )
    ),
    'delete' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => '/delete/:id/:slug/:md5',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'delete'
        ),
        'reqs' => array(
            'id'   => '\d+',
            'slug' => '([a-zA-Z0-9\-_]+)',
            'md5'  => '([a-f0-9]+)',
        )
    )
);