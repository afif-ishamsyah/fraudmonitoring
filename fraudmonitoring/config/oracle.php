<?php

return [
    'oracle' => [
            'driver'        => 'oracle',
            'tns'           => env('DB_TNS', ''),
            'host'          => env('DB_HOST', 'localhost'),
            'port'          => env('DB_PORT', '1521'),
            'database'      => env('DB_DATABASE', 'XE'),
            'username'      => env('DB_USERNAME', 'fraud'),
            'password'      => env('DB_PASSWORD', 'fraudmonitoring'),
            'charset'       => env('DB_CHARSET', 'AL32UTF8'),
            'prefix'        => env('DB_PREFIX', ''),
            'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        ],

        'oracle2' => [
            'driver'        => 'oracle',
            'tns'           => '',
            'host'          => 'localhost',
            'port'          => '1521',
            'database'      => 'XE',
            'username'      => 'fastel',
            'password'      => 'fastel',
            'charset'       => 'AL32UTF8',
            'prefix'        => '',
            'prefix_schema' => '',
        ],
];
