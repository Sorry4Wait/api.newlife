<?php


namespace app\modules\v1\controllers;


use app\modules\v1\components\CorsCustom;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use Yii;

class BaseApiController extends ActiveController
{
    public $serializer = [
        'class' => 'app\components\MySerializer',
        'collectionEnvelope' => 'items',
    ];

    public $enableCsrfValidation = false;
    public $controllerName = '';

    public function checkAccess($action, $model = null, $params = [])
    {
//        if (Yii::$app->authManager->getPermission($this->controllerName . "/" . $action)) {
//            if (!Yii::$app->user->can($this->controllerName . "/" . $action)) {
//                throw new ForbiddenHttpException();
//            }
//        }

        parent::checkAccess($action, $model, $params);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => CorsCustom::className(),
            ],
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formatParam' => '_format', // default '_format'
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'xml' => Response::FORMAT_XML,
                ],
            ],

            [
                'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
                'except' => ['login']
            ]
        ]);
    }
}