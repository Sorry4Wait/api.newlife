<?php

namespace app\modules\admin\controllers;

use app\models\Users;
use app\modules\toquv\models\ToquvDepartments;
use Yii;
use app\modules\admin\models\ToquvUserDepartment;
use app\modules\admin\models\ToquvUserDepartmentSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserDepartmentController implements the CRUD actions for ToquvUserDepartment model.
 */
class UserDepartmentController extends Controller
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
     * Lists all ToquvUserDepartment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ToquvUserDepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ToquvUserDepartment model.
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
     * Creates a new ToquvUserDepartment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ToquvUserDepartment();

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $isAllSaved = false;
            if(!empty($data['departments'])){
                $dataLoop = [];
                foreach ($data['departments'] as $departmentId){
                    $isAllSaved = false;
                    $modelLoop = new ToquvUserDepartment();
                    $dataLoop = $data;
                    $dataLoop['ToquvUserDepartment']['department_id'] = $departmentId;
                    if ($modelLoop->load($dataLoop) && $modelLoop->save()) {
                        $isAllSaved = true;
                        unset($modelLoop);
                    }
                }
            }
            if ($isAllSaved) {
                return $this->redirect(['index']);
            }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->cp['rows'] = [];
        $departments = ToquvUserDepartment::find()->where(['user_id' => $model->user_id])->all();

        if(!empty($departments)){
            foreach ($departments as $key => $item){
                array_push($model->cp['rows'], $item['department_id']);
            }
        }
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $isAllSaved = false;
            //Delete all old items
            if($departments !== null){
                foreach ($departments as $item){
                    $item->delete();
                }
            }

            if(!empty($data['departments'])){
                $dataLoop = [];
                foreach ($data['departments'] as $departmentId){
                    $isAllSaved = false;
                    $modelLoop = new ToquvUserDepartment();
                    $dataLoop = $data;
                    $dataLoop['ToquvUserDepartment']['department_id'] = $departmentId;
                    if ($modelLoop->load($dataLoop) && $modelLoop->save()) {
                        $isAllSaved = true;
                        unset($modelLoop);
                    }
                }
            }
            if ($isAllSaved) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $userDeps = ToquvUserDepartment::find()->where(['user_id' => $model->user_id])->all();

        if($userDeps !== null){
            foreach ($userDeps as $item){
                $item->delete();
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ToquvUserDepartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ToquvUserDepartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ToquvUserDepartment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('messages', 'The requested page does not exist.'));
    }
}
