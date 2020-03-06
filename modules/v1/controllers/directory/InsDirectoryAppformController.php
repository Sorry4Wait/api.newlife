<?php


namespace app\modules\v1\controllers\directory;


use app\modules\directory\models\InsDirectoryAppform;
use app\modules\v1\controllers\BaseApiRestController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class InsDirectoryAppformController extends BaseApiRestController
{
    public $controllerName = 'ins-directory-appform';

    public function actionIndex()
    {
        $search = \Yii::$app->request->post()['search'];
        $limit = \Yii::$app->request->post()['limit'];
        $page = \Yii::$app->request->post()['page'];
        $page = $page === 1 ? 0  : ($page - 1) * $limit;
        $query = InsDirectoryAppform::find()
            ->offset($page)
            ->limit($limit);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $relationShips = $dataProvider->getModels();
        $response = [];
        $response['items'] = $relationShips;
        $response['total'] = InsDirectoryAppform::find()->count();
        return $this->asJson($response);
    }

    public function actionUpdate()
    {
        $model = new InsDirectoryAppform();

        if (\Yii::$app->request->post('InsDirectoryAppform')['id'] !== null) {
            $model = InsDirectoryAppform::findOne(\Yii::$app->request->post('InsDirectoryAppform')['id']);
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
        $model = InsDirectoryAppform::findOne($id);
        if (!$model) {
            throw  new NotFoundHttpException();
        }
        return $this->asJson($model);
    }

    public function actionDelete($id)
    {
        $model = InsDirectoryAppform::findOne($id);
        if (!$model) {
            throw  new NotFoundHttpException();
        }
        return $model->delete();
    }
}