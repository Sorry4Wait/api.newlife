<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\AuthAssignment;
use Yii;
use app\modules\admin\models\AdminUsers;
use app\modules\admin\models\AdminUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    public function beforeAction($action)
    {
//        if(!Yii::$app->user->can('users/'.Yii::$app->controller->action->id))
//            throw new ForbiddenHttpException(Yii::t('app','You are not allowed to perform this action.'));
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * Creates a new AdminUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->request->isAjax)
            return $this->redirect('index');

        $model = new AdminUsers(['scenario' => AdminUsers::SCENARIO_CREATE]);
        //$model = new AdminUsers();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                foreach ($model->roles as $role) {
                    $auth = Yii::$app->authManager;
                    $asign_role = $auth->getRole($role);
                    $auth->assign($asign_role, $model->id);
                }
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
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = AdminUsers::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (!empty($model->roles)) {
                    $this->deleteUserRoles($model->id);
                    foreach ($model->roles as $role) {
                        $auth = Yii::$app->authManager;
                        $asign_role = $auth->getRole($role);
                        $auth->assign($asign_role, $model->id);
                    }
                }
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
     * Deletes an existing AdminUsers model.
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
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUsers::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('messages', 'The requested page does not exist.'));
    }

    protected function deleteUserRoles($id)
    {
        foreach (AuthAssignment::find()->where(['user_id' => $id])->all() as $roles) {
            $roles->delete();
        }
    }


}