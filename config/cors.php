<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

    'allowed_origins' => [
        'https://seangkongheng.site',
        'https://panel.seangkongheng.site',
    ],


    // 'allowed_origins' => [
    //     'http://localhost:5173',
    //     'http://127.0.0.1:5173',
    // ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Content-Type',
        'X-Requested-With',
        'Authorization',
        'Accept',
        'Origin',
    ],

    'exposed_headers' => [],

    'max_age' => 86400,

    'supports_credentials' => false,
];
