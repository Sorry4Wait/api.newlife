<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\AuthItemChild;
use Yii;
use app\modules\admin\models\AuthItem;
use app\modules\admin\models\AuthItemSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class
AuthItemController extends Controller
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
//        echo Yii::$app->controller->module->id;
//        echo "<pre>";
//        print_r(Yii::$app->authManager->getPermissions());
//        echo "</pre>";
//       echo  ArrayHelper::keyExists(Yii::$app->controller->id."/".Yii::$app->controller->action->id,Yii::$app->authManager->getPermissions());
//        exit();
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['type' => 1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionPermissions()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['type' => 2]);

        return $this->render('permissions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
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
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        $models = AuthItem::find()->where(['type' => 2])->all();
        $perms = ArrayHelper::map($models , 'name' ,'description_'.Yii::$app->language ,'category');
        $parents = AuthItem::find()->select('name')->where(['type' => '1'])->asArray()->all();
        $model->type = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

//            $perms = Yii::$app->request->post()['AuthItem']['perms'];
//            $parents = Yii::$app->request->post()['AuthItem']['parents'];
//
//            if($perms[0] == 1){
//                ArrayHelper::remove($perms,0);
//                foreach ($perms as $key => $value){
//                    if((int)$value == 1){
//                        $auth = Yii::$app->authManager;
//                        $role = Yii::$app->authManager->getRole($model->name);
//                        $perm = Yii::$app->authManager->getPermission($key);
//                        $auth->addChild($role,$perm);
//                    }
//                }
//            }

            if(!empty($parents)){
                foreach ($parents as $key => $value){
                        $auth = Yii::$app->authManager;
                        $sub_role = Yii::$app->authManager->getRole($value);
                        $top_role = Yii::$app->authManager->getRole($model->name);
                        $auth->addChild($top_role,$sub_role);
                }
            }

            return $this->redirect(['view', 'id' => $model->name]);
        }


        return $this->render('create', [
            'model' => $model,
            'perms' => $perms,
            'parents' => $parents,

        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePermission()
    {
        $model = new AuthItem();
        $model->type = 2;
        $models = [new AuthItem()];
        $model->new_permissions = [
            [
                'name' => 'index',
                'description' => 'Index',
            ],
            [
                'name' => 'create',
                'description' => 'Create',
            ],
            [
                'name' => 'update',
                'description' => 'Update',
            ],
            [
                'name' => 'delete',
                'description' => 'Delete',
            ],
            [
                'name' => 'view',
                'description' => 'View',
            ],
        ];
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            if(!empty($data['AuthItem']['new_permissions'])){
                foreach ($data['AuthItem']['new_permissions'] as $item){
                    $dataAI = [];
                    $m = new AuthItem();
                    $dataAI['AuthItem']['name'] = $data['AuthItem']['name'].'/'.$item['name'];
                    $dataAI['AuthItem']['category'] = $data['AuthItem']['category'];
                    $dataAI['AuthItem']['description_uz'] = $item['description_uz'];
                    $dataAI['AuthItem']['description_ru'] = $item['description_ru'];
                    $dataAI['AuthItem']['type'] = 2;

                    if($m->load($dataAI) && $m->save()){
                        $auth = Yii::$app->authManager;
                        $role = Yii::$app->authManager->getRole($m->category);
                        $permission = Yii::$app->authManager->getPermission($m->name);
                        $auth->addChild($role,$permission);
                    }
                }
            }

            return $this->redirect(['permissions']);
        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $auth = Yii::$app->authManager;
//            $role = Yii::$app->authManager->getRole($model->category);
//            $permission = Yii::$app->authManager->getPermission($model->name);
//            $auth->addChild($role,$permission);
//
//            return $this->redirect(['view', 'id' => $model->name]);
//        }

        return $this->render('create_permission', [
            'model' => $model,
            'models' => $models
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models = AuthItem::find()->where(['type' => 2])->all();
        $perms = ArrayHelper::map($models , 'name' ,'description_'.Yii::$app->language ,'category');
        $parents = AuthItem::find()->select('name')->where(['type' => '1'])->andWhere(['!=','name', $model->name])->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->type !== 2){
                $auth = Yii::$app->authManager;
                $perms = Yii::$app->request->post()['AuthItem']['perms'];
                $parents = Yii::$app->request->post()['AuthItem']['parents'];

                $this->deletePerms($model->name);
//                if($perms[0] == 1){
//                    ArrayHelper::remove($perms,0);
//
//
//                }
                foreach ($perms as $key => $value){
                    if((int)$value == 1){

                        $auth = Yii::$app->authManager;
                        $role = Yii::$app->authManager->getRole($model->name);
                        $perm = Yii::$app->authManager->getPermission($key);
                        $auth->addChild($role,$perm);
                    }
                }

                $this->deleteParents($model->name);
                if(!empty($parents)){
                    foreach ($parents as $key => $value){
                        $auth = Yii::$app->authManager;
                        $sub_role = Yii::$app->authManager->getRole($value);
                        $top_role = Yii::$app->authManager->getRole($model->name);
                        $auth->addChild($top_role,$sub_role);
                    }
                }

            }

            if($model->type == 2){
                $auth = Yii::$app->authManager;
                $this->deletePermission($model->name);
                $role = Yii::$app->authManager->getRole($model->category);
                $permission = Yii::$app->authManager->getPermission($model->name);
                $auth->addChild($role,$permission);
            }

            if($model->type !== 2){
                return $this->redirect(['index']);
            }else{
                return $this->redirect(['permissions']);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'perms' => $perms,
            'parents' => $parents,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();


        if(strpos(Yii::$app->request->referrer,'view')){
            return $this->redirect('index');
        }
         return $this->redirect(Yii::$app->request->referrer);

    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('messages', 'The requested page does not exist.'));
    }

    protected function deletePerms($parent)
    {

        foreach (AuthItemChild::find()->where(['parent' => $parent])->andWhere(['like','child','%/%',false])->all() as $child) {
            $child->delete();
        }
    }
    protected function deleteParents($parent)
    {

        foreach (AuthItemChild::find()->where(['parent' => $parent])->andWhere(['not like','child','%/%',false])->all() as $child) {
            $child->delete();
        }
    }

    protected function deletePermission($perm)
    {
        $model = AuthItemChild::find()->where(['child' => $perm])->one();
        if(!empty($model))
            $model->delete();
    }

    public function actionTest()
    {
        $models = AuthItem::find()->where(['type' => 2])->all();

       /// print_r($models);
        echo "<pre>";
        print_r($models);
        echo "</pre>";

    }

}
