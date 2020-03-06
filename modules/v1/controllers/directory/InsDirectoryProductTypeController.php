<?php


namespace app\modules\v1\controllers\directory;


use app\modules\directory\models\InsDirectoryProductType;
use app\modules\v1\controllers\BaseApiRestController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class InsDirectoryProductTypeController extends BaseApiRestController
{
    public $controllerName = 'ins-directory-product-type';

    public function actionIndex()
    {
        $search = \Yii::$app->request->post()['search'];
        $limit = \Yii::$app->request->post()['limit'];
        $page = \Yii::$app->request->post()['page'];
        $page = $page === 1 ? 0  : ($page - 1) * $limit;
        $query = InsDirectoryProductType::find()
            ->offset($page)
            ->limit($limit);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $relationShips = $dataProvider->getModels();
        $response = [];
        $response['items'] = $relationShips;
        $response['total'] = InsDirectoryProductType::find()->count();
        return $this->asJson($response);
    }

    public function actionUpdate()
    {
        $model = new InsDirectoryProductType();

        if (\Yii::$app->request->post('InsDirectoryProductType')['id'] !== null) {
            $model = InsDirectoryProductType::findOne(\Yii::$app->request->post('InsDirectoryProductType')['id']);
        }
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                return true;
            } else {
                return $this->asJson($model->getErrors());
            }
        }
    }

    public function actionGet($id)
    {
        $user = InsDirectoryProductType::findOne($id);
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $this->asJson($user);
    }

    public function actionDelete($id)
    {
        $user = InsDirectoryProductType::findOne($id);
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $user->delete();
    }
}