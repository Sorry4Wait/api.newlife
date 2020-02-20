<?php

namespace app\modules\icase\controllers;

use app\modules\icase\models\InsInsuredClientsSearch;
use GuzzleHttp\Client;
use Yii;
use app\modules\icase\models\InsInsuredClients;
use app\modules\icase\models\InsInsuredClientsSearchModel;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsInsuredClientsController implements the CRUD actions for InsInsuredClients model.
 */
class InsInsuredClientsController extends Controller
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

    public function actionSendTest()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://osago.gross.uz/api_e_osgo_uz.php',
            [
                'json' => [
                    "send_id" => "1679091c5a880faf6fb5e6087eb1b2dc",
                    "request" => [
                        "pinfl" => "30106910251695",
                        "passportSeries" => "AB",
                        "passportNumber" => "0041793"
                    ]
                ]
            ]);

        echo $response->getBody();
    }

    /**
     * Lists all InsInsuredClients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsInsuredClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsInsuredClients model.
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
     * Creates a new InsInsuredClients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        if (!Yii::$app->request->isAjax)
            return $this->redirect('index');

        $model = new InsInsuredClients();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'status' => 0,
                    'model' => [
                        'id' => $model->getPrimaryKey(),
                        'fio' => $model->surname_latin . ' ' . $model->name_latin . ' ' . $model->patronym_latin,
                        'inn' => $model->inn,
                        'passport_info' => $this->actionGetPassportInfo($model),
                        'birth_info' => $model->birth_date . ', ' . $model->birth_place . '(' . $model->birth_country . ')',
                        'code' => 1,
                    ]
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
     * Updates an existing InsInsuredClients model.
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
     * Deletes an existing InsInsuredClients model.
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

    public function actionClientSearch()
    {
        $client = new InsInsuredClientsSearchModel();

        return $this->renderAjax('client-search', [
            'client' => $client
        ]);
    }

    /**
     * Finds the InsInsuredClients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsInsuredClients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsInsuredClients::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('messages', 'The requested page does not exist.'));
    }

    public function actionCheck()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new InsInsuredClients();
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $document = $data['InsInsuredClientsSearchModel']['document'];
            $pinpp = $data['InsInsuredClientsSearchModel']['pinpp'];
            $person = InsInsuredClients::find()->where(['document' => $document])->andWhere(['pinpp' => $pinpp])->one();
            if (!$person) {

                $model = $this->getClientInfo($document, $pinpp);
                if ($model) {
//                    if ($model->save(false)) {
//
//                    }
                    return [
                        'status' => 'found',
                        'id' => $model->getPrimaryKey(),
                        'fio' => $model->surname_latin . ' ' . $model->name_latin . ' ' . $model->patronym_latin,
                        'inn' => $model->inn,
                        'passport_info' => $this->actionGetPassportInfo($model),
                        'birth_info' => $model->birth_date . ', ' . $model->birth_place . '(' . $model->birth_country . ')',
                        'code' => 1,
                    ];
                } else {
                    return [
                        'status' => 'create_new_client',
                    ];
                }

            } else {
                return [
                    'status' => 'found',
                    'id' => $person->id,
                    'fio' => $person->surname_latin . ' ' . $person->name_latin . ' ' . $person->patronym_latin,
                    'inn' => $person->inn,
                    'passport_info' => $this->actionGetPassportInfo($person),
                    'birth_info' => $person->birth_date . ', ' . $person->birth_place . '(' . $person->birth_country . ')',
                    'code' => 1,
                ];
            }


        }
        return false;
    }

    protected function actionGetGender($id)
    {
        return $id ? "Мужчина" : ":Женщина";
    }

    protected function actionGetPassportInfo($model)
    {
        return $model->document . ', ' . $model->doc_give_place . ', ' . $model->date_end_document . ', ' . $this->actionGetGender($model->sex) . ', ' . $model->nationality;
    }

    protected function getClientInfo($document, $pinpp)
    {
        $json_data = ['document' => $document, 'pinfl' => $pinpp, 'lang' => "2"];
        $json_data = json_encode($json_data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://192.168.100.16/bdful/person/");

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($ch);
        curl_close($ch);
        $model = new InsInsuredClients();
        $response = json_decode($response);
        if (isset($response->detail)) {
            return false;
        } else {
            return $response;
//            $model->document = $response->document;
//            $model->pinpp = $response->pinfl;
//            $model->lang_id = 2;
//            $model->name_latin = $response->name_latin;
//            $model->surname_latin = $response->surname_latin;
//            $model->patronym_latin = $response->patronym_latin;
//            $model->name_engl = $response->name_engl;
//            $model->surname_engl = $response->surname_engl;
//            $model->birth_date = $response->birth_date;
//            $model->birth_place = $response->birth_place;
//            $model->birth_place_id = $response->birth_place_id;
//            $model->birth_country = $response->birth_country;
//            $model->birth_country_id = $response->birth_country_id;
//            $model->livestatus = $response->livestatus;
//            $model->nationality = $response->nationality;
//            $model->nationality_id = $response->nationality_id;
//            $model->citizenship = $response->citizenship;
//            $model->citizenship_id = $response->citizenship_id;
//            $model->sex = $response->sex;
//            $model->doc_give_place = $response->doc_give_place;
//            $model->doc_give_place_id = $response->doc_give_place_id;
//            $model->date_begin_document = $response->date_begin_document;
//            $model->date_end_document = $response->date_end_document;
//            $model->who_registred = 1;
        }
        return $model;
    }
}
