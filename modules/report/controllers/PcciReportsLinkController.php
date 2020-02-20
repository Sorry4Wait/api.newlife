<?php

namespace app\modules\report\controllers;

use Yii;
use app\modules\report\models\PcciReportsLink;
use app\modules\report\models\PcciReportsLinkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PcciReportsLinkController implements the CRUD actions for PcciReportsLink model.
 */
class PcciReportsLinkController extends Controller
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

//    /**
//     * Lists all PcciReportsLink models.
//     * @return mixed
//     */
//    public function actionIndex()
//    {
//        $searchModel = new PcciReportsLinkSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionIndex($report_id)
    {
        $model = new PcciReportsLink();
        $searchModel = new PcciReportsLinkSearch();
        $dataProvider = $searchModel->search([$searchModel->formName() => ['reports_id' => $report_id]]);
        return $this->renderPartial('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ], false
        );
    }

    /**
     * Displays a single PcciReportsLink model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $path = Yii::$app->basePath . '/data/';
        $model = $this->findModel($id);
        if (file_exists($path . $model->link)) {
            return Yii::$app->response->xSendFile($path . $model->link);
        } else {
            throw new NotFoundHttpException("{$model->link} is not found!");
        }

    }

    /**
     * @return string
     */

    public function actionUpload()
    {
        $model = new PcciReportsLink();

        if (Yii::$app->request->isPost) {
            $model->link = UploadedFile::getInstance($model, 'link');
            if ($model->link->saveAs(Yii::$app->basePath . '/data/' . $model->link->baseName . '.' . $model->link->extension)) {
                $model->link = $model->link->baseName . '.' . $model->link->extension;
                $model->reports_id = $_POST['PcciReportsLink']['reports_id'];
                $model->creator_id = \Yii::$app->user->identity->id;
                if ($model->save(false)) {
                    \Yii::$app->session->setFlash('uploadMsg', 'File added successfully!');
//                    return Yii::$app->getResponse()->redirect(array('report/pcci-reports/index'));
                    return $this->redirect(['pcci-reports/index']);
                }
            }

        }

    }

    /**
     * Creates a new PcciReportsLink model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PcciReportsLink();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PcciReportsLink model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PcciReportsLink model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id = 0)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/report/pcci-reports/index']);
    }

    /**
     * Finds the PcciReportsLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PcciReportsLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PcciReportsLink::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload($id = 0)
    {
        print_r($id);
        exit;
        Yii::$app->response->headers->set('Content-type', ['application/pdf']);
        return Yii::$app->response->sendFile('/pc.local/data/', $link, ['inline' => true]);
    }
}
