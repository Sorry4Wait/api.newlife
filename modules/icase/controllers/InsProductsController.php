<?php

namespace app\modules\icase\controllers;

use app\modules\icase\models\InsClassificationSearch;
use app\modules\icase\models\InsProductsAppformSearch;
use app\modules\icase\models\InsProductsCalculationSearch;
use app\modules\icase\models\InsProductsClassificationSearch;
use Yii;
use app\modules\icase\models\InsProducts;
use app\modules\icase\models\InsProductsSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * InsProductsController implements the CRUD actions for InsProducts model.
 */
class InsProductsController extends Controller
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
     * Lists all InsProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new InsProducts();
        $searchModel = new InsProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionChangeStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $status = Yii::$app->request->post('value');
        $model = InsProducts::find()->where(['id' => $id])->one();

        $model->id_product_status = (int)$status;
        $result = ['success'=>false];
        if($model->save()) {
            $text = $model->getStatusList($model->id_product_status);
            $btnClass = $model->id_product_status == 1 ? 'btn btn-xs btn-success' : 'btn btn-xs btn-danger';
            $button = Html::button($text, ['class' => $btnClass]);
            $result = ['success' => true, 'btn' => $button, 'id' => $model->id];
        }
        return $result;
    }

    /**
     * Displays a single InsProducts model.
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
     * Creates a new InsProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->request->isAjax)
            return $this->redirect('index');

        $model = new InsProducts();
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

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InsProducts model.
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
     * Deletes an existing InsProducts model.
     * @param integer $id
     * @return array
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
     * Finds the InsProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsProducts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('messages', 'The requested page does not exist.'));
    }

    public function actionDetailView($id)
    {
        $model = $this->findModel($id);

        $searchModelInsProdClass = new InsProductsClassificationSearch();
        $dataProviderInsProdClass= $searchModelInsProdClass->search([$searchModelInsProdClass->formName() => ['id_products' => $id]]);

        $searchModelCalculation = new InsProductsCalculationSearch();
        $dataProviderCalculation = $searchModelCalculation->search([$searchModelCalculation->formName() => ['id_products' => $id]]);

        $searchModelAppform = new InsProductsAppformSearch();
        $dataProviderAppform = $searchModelAppform->search([$searchModelAppform->formName() => ['id_ins_products' => $id]]);

        return $this->render('detail-view', [
            'dataProviderInsProdClass' => $dataProviderInsProdClass,
            'searchModelInsProdClass' => $searchModelInsProdClass,
            'searchModelCalculation' => $searchModelCalculation,
            'dataProviderCalculation' => $dataProviderCalculation,
            'searchModelAppform' => $searchModelAppform,
            'dataProviderAppform' => $dataProviderAppform,
            'model' => $model
        ]);
    }
}
