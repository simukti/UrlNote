<?php
return array(
    'adapter' => 'pdo_mysql',
    'params'  => array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => 'admin',
        'dbname'    => 'url_note'
    ),
    'isDefaultTableAdapter' => true,
    'defaultMetadataCache'  => 'dbMetadata'
);