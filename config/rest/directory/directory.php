<?php

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/ins-directory-product-type' => 'v1/directory/ins-directory-product-type',
            'v1/ins-directory-product-kind' => 'v1/directory/ins-directory-product-kind',
            'v1/ins-directory-calculation-type' => 'v1/directory/ins-directory-calculation-type',
            'v1/ins-directory-prefix' => 'v1/directory/ins-directory-prefix',
            'v1/ins-directory-departcodes' => 'v1/directory/ins-directory-departcodes',
            'v1/ins-directory-appform' => 'v1/directory/ins-directory-appform'
        ],
        'pluralize' => false,
        'prefix' => 'api',
        'extraPatterns' => [
            'POST,OPTIONS index' => 'index',
            'POST,OPTIONS update' => 'update',
            'GET,OPTIONS get/<id>' => 'get',
            'DELETE,OPTIONS delete/<id>' => 'delete'

        ],
    ],


];