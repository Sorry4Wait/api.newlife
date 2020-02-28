<?php

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/site'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'POST,OPTIONS login' => 'login',

        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/user' => 'v1/admin/user'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'POST,OPTIONS index' => 'index',
            'POST,OPTIONS update' => 'update',
            'GET,OPTIONS get/<id>' => 'get',
            'DELETE,OPTIONS delete/<id>' => 'delete'

        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/role' => 'v1/admin/role'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'GET,OPTIONS list' => 'list',

        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['v1/auth-item' => 'v1/admin/auth-item'],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'GET,OPTIONS permissions' => 'permissions',
            'GET,OPTIONS index' => 'index',
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