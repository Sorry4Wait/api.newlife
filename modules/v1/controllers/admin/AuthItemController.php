<?php


namespace app\modules\v1\controllers\admin;


use app\modules\admin\models\AuthItem;
use app\modules\admin\models\AuthItemChild;
use app\modules\v1\components\CorsCustom;
use app\modules\v1\controllers\BaseApiController;
use app\modules\v1\controllers\BaseApiRestController;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class AuthItemController extends BaseApiRestController
{
    public $controllerName = 'auth-item';


    public function actionList()
    {
        return $this->asJson(Yii::$app->authManager->getPermissions());
    }

    public function actionIndex()
    {
        $search = \Yii::$app->request->post()['search'];
        $limit = \Yii::$app->request->post()['limit'];
        $page = \Yii::$app->request->post()['page'];
        $page = $page === 1 ? 0  : ($page - 1) * $limit;
        $query = AuthItem::find()->where(['type' => 1])
            ->offset($page)
            ->limit($limit);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $relationShips = $dataProvider->getModels();
        $response = [];
        $response['items'] = $relationShips;
        $response['total'] = AuthItem::find()->where(['type' => 1])->count();
        return $this->asJson($response);
    }

    public function actionUpdate()
    {
        $model = new AuthItem();

        if (\Yii::$app->request->post('AuthItem')['name'] !== null) {
            $model = AuthItem::findOne(\Yii::$app->request->post('AuthItem')['name']);
        }

        if ($model->load(\Yii::$app->request->post())) {
            $model->type = 1;
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function actionCreate()
    {
        $model = new AuthItem();
        $arr = [];
        $arr['AuthItem'] = Yii::$app->request->post();
        $model->load($arr);
        $model->type = 1;
        return $model->save();
    }

    /**
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     * @var $role | from POST
     * @var $permissions | from POST
     */

    public function actionAssign()
    {
        $perms = Yii::$app->request->post('permissions');

        $role = Yii::$app->authManager->getRole(trim(Yii::$app->request->post('role')));
        $auth = Yii::$app->authManager;
        if (!$role || sizeof($perms) === 0) {
            throw new NotFoundHttpException();
        }

        $this->deleteRolePerms(trim(Yii::$app->request->post('role')));
        foreach ($perms as $perm) {

            if ($permission = Yii::$app->authManager->getPermission($perm)) {
                $permission = Yii::$app->authManager->getPermission($perm);
                $auth->addChild($role, $permission);
            }

        }
        return $this->asJson(
            [
                'status' => true,
                'message' => 'Changes saved successfully!'
            ]
        );
    }

    public function actionGet($id)
    {
        $user = AuthItem::find()->where(['name' => $id])->one();
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $this->asJson($user);
    }

    public function actionDelete($id)
    {
        $user = AuthItem::find()->where(['name' => $id])->one();
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $user->delete();
    }

    protected function deletePermission($perm)
    {
        $model = AuthItemChild::find()->where(['child' => $perm])->one();
        if (!empty($model))
            $model->delete();
    }

    protected function deleteRolePerms($parent)
    {
        foreach (AuthItemChild::find()->where(['parent' => $parent])->andWhere(['like', 'child', '%/%', false])->all() as $child) {
            $child->delete();
        }
    }


}