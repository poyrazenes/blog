<?php

return [
    'app' => [
        'routes' => [
            'web' => env('ROUTE_WEB'),
            'api' => env('ROUTE_API'),
        ],
        'domains' => [
            'web' => env('DOMAIN_WEB'),
            'api' => env('DOMAIN_API'),
        ]
    ]
];
