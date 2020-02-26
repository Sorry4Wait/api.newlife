<?php

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/user'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'OPTIONS login' => 'login',
            'POST login' => 'login',

        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/auth-item' => 'v1/admin/auth-item'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'GET permissions' => 'permissions',
            'GET index' => 'index',
            'POST assign' => 'assign',
            'GET update' => 'update',
            'POST create' => 'create',
            'DELETE delete' => 'delete'
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/ins-insured-clients' => 'v1/icase/ins-insured-clients'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'GET test' => 'test',
        ],
    ]
];