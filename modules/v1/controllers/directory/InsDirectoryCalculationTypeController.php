<?php


namespace app\modules\v1\controllers\directory;


use app\modules\directory\models\InsDirectoryCalculationType;
use app\modules\directory\models\InsDirectoryProductType;
use app\modules\v1\controllers\BaseApiRestController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class InsDirectoryCalculationTypeController extends BaseApiRestController
{
    public $controllerName = 'ins-directory-calculation-type';
    public function actionIndex()
    {
        $search = \Yii::$app->request->post()['search'];
        $limit = \Yii::$app->request->post()['limit'];
        $page = \Yii::$app->request->post()['page'];
        $page = $page === 1 ? 0  : ($page - 1) * $limit;
        $query = InsDirectoryCalculationType::find()
            ->offset($page)
            ->limit($limit);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $relationShips = $dataProvider->getModels();
        $response = [];
        $response['items'] = $relationShips;
        $response['total'] = InsDirectoryCalculationType::find()->count();
        return $this->asJson($response);
    }

    public function actionUpdate()
    {
        $model = new InsDirectoryCalculationType();

        if (\Yii::$app->request->post('InsDirectoryCalculationType')['id'] !== null) {
            $model = InsDirectoryCalculationType::findOne(\Yii::$app->request->post('InsDirectoryCalculationType')['id']);
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
        $user = InsDirectoryCalculationType::findOne($id);
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $this->asJson($user);
    }

    public function actionDelete($id)
    {
        $user = InsDirectoryCalculationType::findOne($id);
        if (!$user) {
            throw  new NotFoundHttpException();
        }
        return $user->delete();
    }
}