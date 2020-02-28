<?php


namespace app\modules\v1\controllers\admin;


use app\modules\admin\models\AuthItem;
use app\modules\v1\controllers\BaseApiRestController;

class RoleController extends BaseApiRestController
{
    public $controllerName = 'role';
    //public $modelClass = 'app\modules\v1\models';

    public function actionList()
    {
        $roles = AuthItem::find()->where(['type' => 1])->all();
        $arr = [];
        if($roles){
            foreach ($roles as $role){
                array_push($arr,$role['name']);
            }

        }
        return $this->asJson($arr);
    }
}