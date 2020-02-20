<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timezone' => "Asia/Tashkent",
    "language" => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\v1',
            'components' => [
//                'response' => [
//                    'class' => 'yii\web\Response',
//                    'format' => yii\web\Response::FORMAT_JSON,
//                    'charset' => 'UTF-8',
//                    'on beforeSend' => function ($event) {
//                        $response = $event->sender;
//                        //if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
//                        if ($response->data !== null) {
//                            $response->data = [
//                                'success' => $response->isSuccessful,
//                                'data' => $response->data,
//                            ];
//                            $response->statusCode = 200;
//                        }
//                    },
//                ],
            ],
        ],
        'treemanager' => [
            'class' => '\kartik\tree\Module',
        ]
    ],
    'components' => [
        'authManager' => [
            // Run migration
            // php yii migrate/up --migrationPath=@yii/rbac/migrations

            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => [],
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => "keyforjwt@qwerty" // Secret key string or path to the public key file
        ],
        'request' => [
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'WBrkaNPU8SlGntmxGk7BXEPPksreB91N',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\AdminUsers',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'messages*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'messages' => 'messages.php',
                    ],
                ],
            ],
        ],
        'db' => $db,
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'on beforeSend' => function ($event) {
                header("Access-Control-Allow-Origin: *");
            }
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'enableStrictParsing' => true,
            'rules' => [
//                [
//                    'class' => 'yii\rest\UrlRule',
//                    'controller' => ['v1/user', 'v1/test'],
//                    'pluralize' => false,
//                    'prefix' => 'api',
//                    'extraPatterns' => [
//                        'POST login' => 'login',
//                        'POST test' => 'test'
//                    ],
//
//                ],
//                [
//                    'class' => 'yii\rest\UrlRule',
//                    'controller' => ['v1/rest'],
//                    'pluralize' => false,
//                    'prefix' => 'api',
//                    'extraPatterns' => [
//                        'GET auth' => 'auth',
//                    ],
//
//                ],
//                [
//                    'class' => 'yii\rest\UrlRule',
//                    'controller' => ['v1/auth'],
//                    'pluralize' => false,
//                    'prefix' => 'api',
//                    'extraPatterns' => [
//                        'POST login' => 'login',
//                    ],
//
//                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/top' => 'v1/icase/test'],
                    'pluralize' => false,
                    'prefix' => 'api',
                    'extraPatterns' => [
                        'GET test' => 'test',
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
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
