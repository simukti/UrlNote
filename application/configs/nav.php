<?php
return array(
    'pages' => array(
        'default' => array(
            'label'     => '{{i class=||icon-home||}}{{/i}} UrlNote',
            'route'     => 'default',
            'order'     => '-100',
            'visible'   => true,
            'id'        => 'default'
        ),
        'add' => array(
            'label'     => '{{i class=||icon-plus||}}{{/i}} Add',
            'route'     => 'add',
            'visible'   => true,
            'id'        => 'add'
        ),
        'tags' => array(
            'label'     => '{{i class=||icon-tags||}}{{/i}} Tags',
            'route'     => 'tags',
            'visible'   => true,
            'id'        => 'tags',
        )
    )
);