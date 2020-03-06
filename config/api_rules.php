<?php
$directory = require 'rest/directory/directory.php';
$arr =  [
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
            'POST,OPTIONS permissions' => 'permissions',
            'POST,OPTIONS index' => 'index',
            'POST,OPTIONS assign' => 'assign',
            'POST,OPTIONS update' => 'update',
            'POST,OPTIONS create' => 'create',
            'GET,OPTIONS get/<id>' => 'get',
            'DELETE,OPTIONS delete/<id>' => 'delete'
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

return array_merge($arr,$directory);