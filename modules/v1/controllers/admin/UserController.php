<?php


namespace app\modules\v1\controllers\admin;


use app\models\AdminUsers;
use app\modules\admin\models\AuthAssignment;
use app\modules\v1\controllers\BaseApiRestController;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class UserController extends BaseApiRestController
{
    public $controllerName = 'users';
    public $modelClass = 'app\models\AdminUsers';

    public function actionIndex()
    {
        $search = \Yii::$app->request->post()['search'];
        $limit = \Yii::$app->request->post()['limit'];
        $page = \Yii::$app->request->post()['page'];
        $query = AdminUsers::find()
            ->where(['like', 'login', $search,])
            ->orWhere(['like', 'first_name', $search,])
            ->orWhere(['like', 'last_name', $search,])
            ->offset($page);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => $limit, //set page size here
            ]
        ]);
        $relationShips = $dataProvider->getModels();
        $response = [];
        $response['items'] = $relationShips;
        $response['total'] = $dataProvider->getTotalCount();
        return $this->asJson($response);
    }

    public function actionUpdate()
    {
        $model = new AdminUsers();

        if (\Yii::$app->request->post('AdminUsers')['id'] !== null) {
            $model = AdminUsers::findOne(\Yii::$app->request->post('AdminUsers')['id']);
        }
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                if (!empty($model->roles)) {
                    $this->deleteUserRoles($model->id);
                    foreach ($model->roles as $role) {
                        $auth = \Yii::$app->authManager;
                        $asign_role = $auth->getRole($role);
                        $auth->assign($asign_role, $model->id);
                    }
                }
                return true;
            } else {
                return false;
            }
        }

    }

    public function actionGet($id)
    {
        $user = AdminUsers::findOne($id);
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $this->asJson($user);
    }

    public function actionDelete($id)
    {
        $user = AdminUsers::findOne($id);
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $user->delete();
    }

    protected function deleteUserRoles($id)
    {
        foreach (AuthAssignment::find()->where(['user_id' => $id])->all() as $roles) {
            $roles->delete();
        }
    }
}