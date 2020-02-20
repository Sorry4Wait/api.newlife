<?php


namespace app\modules\v1\controllers\admin;


use app\modules\admin\models\AuthItem;
use app\modules\admin\models\AuthItemChild;
use app\modules\v1\components\CorsCustom;
use app\modules\v1\controllers\BaseApiController;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class AuthItemController extends Controller
{
    public $controllerName = 'auth-item';

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => CorsCustom::className(),
        ];
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            //  'except' => ['login'],
        ];
        return $behaviors;
    }

    public function actionList()
    {
        return $this->asJson(Yii::$app->authManager->getPermissions());
    }

    public function actionIndex($limit = 10, $page = 1)
    {
        $query = AuthItem::find()->where(['type' => 1])->offset($page);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => $limit, //set page size here
            ]
        ]);
        $items = $dataProvider->getModels();
        $response = [];
        $response['items'] = $items;
        $response['total'] = $dataProvider->getTotalCount();

        return $this->asJson($response);
    }
    public function actionUpdate($id)
    {

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