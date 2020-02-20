<?php


namespace app\modules\v1\controllers;

use app\modules\toquv\models\ToquvMusteri;
use app\modules\v1\components\CorsCustom;
use app\modules\v1\models\Users;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use Yii;

class UserController extends BaseApiController
{
    public $modelClass = 'app\modules\v1\models\Users';


    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['POST'],
                ],
            ],

        ]);
    }

    public function actionLogin()
    {
        $request = Yii::$app->getRequest();
        $username = $request->bodyParams['username'];
        $password = $request->bodyParams['password'];
        $user = Users::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            $user->generateToken();
            $user->last_login_date = date("Y-m-d H:i:s");
            $user->save();
            return $this->asJson(['token' => $user->token]);
        } else {
            return $this->asJson(['success' => false, 'error' => $user->getErrors(), 'userpas' => $user->password, 'jsonpas' => md5($password)]);
        }


    }


}