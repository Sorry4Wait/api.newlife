<?php

namespace app\modules\v1\controllers;

use app\modules\v1\components\CorsCustom;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        $behaviors = parent::behaviors();


        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => ['*'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 86400,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => [],
            ]
        ];
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
          $behaviors['authenticator']['except'] = ['options'];
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
                'user' => $modelUser,
                'token' => $token,
                'permissions' => $this->getPermissions($modelUser->id)
            ];
        }

        throw new NotFoundHttpException();
    }

    protected function getPermissions($id)
    {
        $perms = Yii::$app->authManager->getPermissionsByUser($id);
        $userPerms = [];
        foreach ($perms as $key => $perm) {
            array_push($userPerms, $key);
        }
        return $userPerms;
    }

}