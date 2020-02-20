<?php

namespace app\modules\icase\controllers;

use app\modules\icase\models\InsInsuredClients;
use Yii;
use app\modules\icase\models\InsApphealthDeclaration;
use app\modules\icase\models\InsApphealthDeclarationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsApphealthDeclarationController implements the CRUD actions for InsApphealthDeclaration model.
 */
class InsApphealthDeclarationController extends Controller
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
     * Lists all InsApphealthDeclaration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsApphealthDeclarationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsApphealthDeclaration model.
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
     * Creates a new InsApphealthDeclaration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InsApphealthDeclaration();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InsApphealthDeclaration model.
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
     * Deletes an existing InsApphealthDeclaration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InsApphealthDeclaration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsApphealthDeclaration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsApphealthDeclaration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeclaration($id, $client)
    {
        if ($id) {
            $model = new InsApphealthDeclaration();
            $insuredPerson = InsInsuredClients::findOne($client);
            return $this->render('declaration', ['model' => $model, 'client' => $insuredPerson, 'form_id' => $id]);
        }
    }

    public function actionSave()
    {
        $model = new InsApphealthDeclaration();
        if ($model->load(Yii::$app->request->post())) {
            $data = $_POST['InsApphealthDeclaration'];
            $model->id_admin_users = Yii::$app->user->identity->id;
            $model->date_completion = Yii::$app->formatter->asDate($data['date_completion'], 'php:Y-m-d H:i:s');
            if ($model->save()) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'status' => 'success',
                    'id_appform' => $data['id_appform'],
                ];
            }
        }
    }
}
