<?php

namespace app\modules\v1\controllers;

use sizeg\jwt\JwtHttpBearerAuth;
use Yii;

class UserController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\AdminUsers';
//    public $serializer = [
//        'class' => 'app\components\MySerializer',
//        'collectionEnvelope' => 'items',
//    ];

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'except' => ['login'],
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
                'permissions' => $this->getPermissions($modelUser->id)
            ];
        }

        return [
            'status' => false,
            'message' => 'Wrong username or password'
        ];
    }

    protected function getPermissions($id)
    {
        $perms = Yii::$app->authManager->getPermissionsByUser($id);
        $userPerms = [];
        foreach ($perms as $key => $perm){
            array_push($userPerms,$key);
        }
        return $userPerms;
    }

}