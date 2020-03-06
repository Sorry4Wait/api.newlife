<?php


namespace app\modules\v1\controllers\directory;


use app\modules\directory\models\InsDirectoryDepartcodes;
use app\modules\v1\controllers\BaseApiRestController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class InsDirectoryDepartcodesController  extends BaseApiRestController
{
    public $controllerName = 'ins-directory-departcodes';

    public function actionIndex()
    {
        $search = \Yii::$app->request->post()['search'];
        $limit = \Yii::$app->request->post()['limit'];
        $page = \Yii::$app->request->post()['page'];
        $page = $page === 1 ? 0  : ($page - 1) * $limit;
        $query = InsDirectoryDepartcodes::find()
            ->offset($page)
            ->limit($limit);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $relationShips = $dataProvider->getModels();
        $response = [];
        $response['items'] = $relationShips;
        $response['total'] = InsDirectoryDepartcodes::find()->count();
        return $this->asJson($response);
    }

    public function actionUpdate()
    {
        $model = new InsDirectoryDepartcodes();

        if (\Yii::$app->request->post('InsDirectoryDepartcodes')['id_department'] !== null) {
            $model = InsDirectoryDepartcodes::findOne(\Yii::$app->request->post('InsDirectoryDepartcodes')['id_department']);
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
        $model = InsDirectoryDepartcodes::find()->where(['id_department' => $id])->one();
        if (!$model) {
            throw  new NotFoundHttpException();
        }
        return $this->asJson($model);
    }

    public function actionDelete($id)
    {
        $model = InsDirectoryDepartcodes::find()->where(['id_department' => $id])->one();
        if (!$model) {
            throw  new NotFoundHttpException();
        }
        return $model->delete();
    }
}