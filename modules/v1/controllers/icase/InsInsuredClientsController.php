<?php

namespace app\modules\v1\controllers\icase;


use app\modules\icase\models\InsInsuredClients;
use app\modules\v1\controllers\BaseApiController;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
/**
 * InsInsuredClientsController implements the CRUD actions for InsInsuredClients model.
 */
class InsInsuredClientsController extends BaseApiController
{
    public $controllerName = 'ins-insured-clients';
    public $modelClass = 'app\modules\icase\models\InsInsuredClients';

//    public function actionIndex()
//    {
//        $query = InsInsuredClients::find();
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'defaultPageSize' => 5, //set page size here
//            ]
//        ]);
//        $relationShips = $dataProvider->getModels();
//        $response = [];
//        $response['items'] = $relationShips;
//        $response['total'] = $dataProvider->getTotalCount();
//        return $this->asJson($response);
//    }
}