<?php

namespace app\modules\directory\controllers;

use Yii;
use app\modules\directory\models\InsDirectoryDepartcodes;
use app\modules\directory\models\InsDirectoryDepartcodesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsDirectoryDepartcodesController implements the CRUD actions for InsDirectoryDepartcodes model.
 */
class InsDirectoryDepartcodesController extends Controller
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
     * Lists all InsDirectoryDepartcodes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsDirectoryDepartcodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsDirectoryDepartcodes model.
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
     * Creates a new InsDirectoryDepartcodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(!Yii::$app->request->isAjax)
            return $this->redirect('index');

        $model = new InsDirectoryDepartcodes();
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
     * Updates an existing InsDirectoryDepartcodes model.
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
     * Deletes an existing InsDirectoryDepartcodes model.
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
     * Finds the InsDirectoryDepartcodes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsDirectoryDepartcodes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsDirectoryDepartcodes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
