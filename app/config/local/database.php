<?php

$subdomain = Request::subdomain() ?: 'www';

return array(

    'default' => 'default',

    'connections' => array(

        'default' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'slap_dev_'.$subdomain,
            'username'  => 'dbu',
            'password'  => 'pass',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

        'root' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'slap_dev_demo',
            'username'  => 'root',
            'password'  => 'pass',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

    ),
);
