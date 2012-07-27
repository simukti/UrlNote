<?php
return array(
    'dbMetadata' => array(
        'frontendBackendAutoload' => false,
        'frontend' => array(
            'name' => 'Core',
            'customFrontendNaming' => false,
            'options' => array(
                'lifetime' => 3600 * 24 * 365,
                'automatic_serialization' => true,
                'automatic_cleaning_factor' => 0,
            ),
        ),
        'backend' => array(
            'name' => 'File',
            'customBackendNaming' => false,
            'options' => array(
                'cache_dir' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'dbMetadata',
                'file_name_prefix' => 'metadata_',
                'cache_file_umask' => 0755,
                'file_locking' => false
            ),
        ),
    ),
);