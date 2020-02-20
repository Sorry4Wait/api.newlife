<?php

namespace app\modules\v1\controllers;

use sizeg\jwt\JwtHttpBearerAuth;
use Yii;

class AuthController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\AdminUsers';

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $username = Yii::$app->request->post('username');
        $pass = Yii::$app->request->post('password');

        $modelUser = \app\models\AdminUsers::findByUsername($username);

        if ($modelUser && $modelUser->validatePassword($pass)) {
            $token = (string)\app\models\AdminUsers::generateToken($modelUser->id);

            return [
                'status' => true,
                'message' => 'Success',
                'token' => $token,
            ];
//            $modelUser->token = $token;
//            if ($modelUser->save()) {
//                return [
//                    'status' => true,
//                    'message' => 'Success',
//                    'token' => $token,
//                ];
//            } else {
//                return [
//                    'status' => false,
//                    'message' => $modelUser->getErrors()
//                ];
//            }

        }

        return [
            'status' => false,
            'message' => 'Wrong username or password'
        ];
    }
}