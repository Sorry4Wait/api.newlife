<?php

namespace app\modules\v1\controllers;

use sizeg\jwt\Jwt;
use Yii;
use yii\rest\Controller;

class RestController extends Controller
{
    public $enableCsrfValidation = false;
    public $modelClass = 'app\models\AdminUsers';
    public function behaviors()
    {
        $behaviors = parent::behaviors();

//        $behaviors['authenticator'] = [
//            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
//        ];

        return $behaviors;
    }
    /**
     * @return \yii\web\Response
     */
    public function actionAuth()
    {
        // here you can put some credentials validation logic
        // so if it success we return token
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $token = $jwt->getBuilder()
            ->setIssuer('http://example.com')
            ->setAudience('http://example.org')
            ->setId('4f1g23a12aa', true)
            ->setIssuedAt(time())
            ->setExpiration(time() + 3600)
            ->set('uid', 15)
            ->sign($signer, $jwt->key)
            ->getToken();

        return $this->asJson([
            'token' => (string)$token,
        ]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionData()
    {
        return $this->asJson([
            'success' => true,
        ]);
    }
}