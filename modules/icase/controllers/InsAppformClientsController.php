<?php

namespace app\modules\icase\controllers;

use app\modules\icase\models\InsApphealthDeclaration;
use app\modules\icase\models\InsClassification;
use app\modules\icase\models\InsInsuredClients;
use app\modules\icase\models\InsProducts;
use app\modules\icase\models\InsProductsAppform;
use app\modules\icase\models\InsProductsClassification;
use Yii;
use app\modules\icase\models\InsAppformClients;
use app\modules\icase\models\InsAppformClientsSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsAppformClientsController implements the CRUD actions for InsAppformClients model.
 */
class InsAppformClientsController extends Controller
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
     * Lists all InsAppformClients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsAppformClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsAppformClients model.
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
     * Creates a new InsAppformClients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InsAppformClients();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InsAppformClients model.
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
     * Deletes an existing InsAppformClients model.
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
     * Finds the InsAppformClients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsAppformClients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsAppformClients::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return string
     */

    public function actionPhysical()
    {
        $model = InsProducts::findAll(['id_product_type' => 1, 'id_product_status' => 1]);

        return $this->renderPartial('_physical_products', [
            'model' => $model,
        ]);
    }

    /**
     *
     */

    public function actionLegal()
    {
        $model = InsProducts::findAll(['id_product_type' => 2, 'id_product_status' => 1]);

        return $this->renderPartial('_entity_products', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */

    public function actionRegistration()
    {
        $model = new InsAppformClients();
        $cl = new InsClassification();
        $modelProductsAppform = InsProductsAppform::findAll(['id_ins_products' => $_POST['id']]);
        $modelProductClassification = InsProductsClassification::findAll(['id_products' => $_POST['id']]);
        $model->productsAppForm = $_POST['id'];
        $model->getConnectedAppForms();
        $txt = "";
        foreach ($modelProductClassification as $m) {
            $txt = $txt . $cl->getClassificationName($m->id_classification) . '.<br>';
        }
        return $this->render('_clients', [
            'model' => $model,
            'client' => new InsInsuredClients(),
            'appform' => $modelProductsAppform,
            'classification' => $txt,
            'product' => InsProducts::findOne($_POST['id'])
        ]);
    }

    /**
     * @return string
     */

    public function actionApplication()
    {
        return $this->render('app_form');
    }

    /**
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\StaleObjectException
     */

    public function actionSave()
    {
        $model = new InsAppformClients();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $data = $_POST['InsAppformClients'];
            $client = InsInsuredClients::findOne($data['id_insured_clients']);
            $client->address = $data['address'];
            $client->phone = $data['phone'];
            $client->work_place = $data['work_place'];
            $client->email = $data['email'];

            $insurer = InsInsuredClients::findOne($data['id_insurer_clients']);
            $insurer->address = $data['address2'];

            $model->attributes = $data;
            $model->id_admin_users = Yii::$app->user->identity->id;
            $model->id_department = Yii::$app->user->identity->department_id;
            $model->app_status = 0;

            if ( $client->save(false) && $insurer->save(false) && $model->save(false)) {
                $transaction->commit();
                return $this->redirect(['ins-apphealth-declaration/declaration', 'id' => $model->getPrimaryKey(), 'client' => $data['id_insured_clients']]);
            } else {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', Yii::t('messages', 'Error in server side try again after few minutes.'));
                return $this->redirect(['ins-appform-clients/index']);

            }

        }
    }

    public function actionTest()
    {
        echo "<pre>";
        print_r(InsAppformClients::getConnectedAppForms());
        echo "</pre>";
        exit();
    }

}
