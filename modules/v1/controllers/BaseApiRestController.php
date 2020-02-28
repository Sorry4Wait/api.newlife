<?php

namespace app\modules\v1\controllers;

use app\modules\v1\components\CorsCustom;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\rest\Controller;

class BaseApiRestController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            // 'except' => ['index'],
        ];
        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;

    }
}