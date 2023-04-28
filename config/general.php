<?php
return [
    'view_path' => __DIR__ . '/../views',
    'default_storage' => 'redis',
    'storage' => [
        'redis' => [
            'scheme' => 'tcp',
            'host'   => 'redis',
            'port'   => 6379,
        ],
    ]
];