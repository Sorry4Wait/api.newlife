<?php


namespace app\modules\v1\controllers\icase;


class TestController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\AdminUsers';

    public function actionTest(){

        return $this->asJson([1 => 2]);
    }
}