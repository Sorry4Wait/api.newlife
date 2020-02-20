<?php

namespace app\modules\icase\controllers;

use app\modules\icase\models\InsProductsAppformSearch;
use app\modules\icase\models\InsProductsCalculation;
use app\modules\icase\models\InsProductsCalculationSearch;
use Yii;
use app\modules\icase\models\InsProductsClassification;
use app\modules\icase\models\InsProductsClassificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsProductsClassificationController implements the CRUD actions for InsProductsClassification model.
 */
class InsProductsClassificationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all InsProductsClassification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $root = $_POST['expandRowKey'];
        $model = new InsProductsClassification();
        $searchModel = new InsProductsClassificationSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search([$searchModel->formName() => ['id_products' => $root]]);

        $modelCalc = new InsProductsCalculation();
        $searchModelCalculation = new InsProductsCalculationSearch();
        $dataProviderCalculation = $searchModelCalculation->search([$searchModelCalculation->formName() => ['id_products' => $root]]);

        $searchModelAppform = new InsProductsAppformSearch();
        $dataProviderAppform = $searchModelAppform->search([$searchModelAppform->formName() => ['id_ins_products' => $root]]);


        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'searchModelCalculation' => $searchModelCalculation,
            'dataProvider' => $dataProvider,
            'dataProviderCalculation' => $dataProviderCalculation,
            'dataProviderAppform' => $dataProviderAppform,
            'product' => $root,
        ], false);
    }

    /**
     * Displays a single InsProductsClassification model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InsProductsClassification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new InsProductsClassification();
        $model->id_products = $id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'status' => '0',
                ];
            } else {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'status' => '1',
                    'errors' => $model->getErrors(),
                ];
            }
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InsProductsClassification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'status' => 0,
                ];
            } else {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'status' => '1',
                    'errors' => $model->getErrors(),
                ];
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InsProductsClassification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            $this->findModel($id)->delete();
            return [
                'status' => 'success',

            ];
        } catch (NotFoundHttpException $e) {
            $message = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            return [
                'status' => 'error',
                'errors' => $message,
            ];
        }
    }

    /**
     * Finds the InsProductsClassification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsProductsClassification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsProductsClassification::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
