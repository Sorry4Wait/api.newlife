<?php

use app\modules\admin\models\AuthItemSearch;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <div class="auth-item-index">
            <div class="card-header row">
                <div class="col col-sm-4">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>

                <div class="col col-sm-8 float-md-right">
                    <?= Html::a(Yii::t('messages', 'Add New') . '<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>', ['create-permission'], ['class' => 'btn  mb-1 gradient-1 btn-rounded float-right create-auth-item', 'id' => 'productButton']) ?>
                </div>
            </div>
            <hr>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'striped' => false,
                'bordered' => false,
                'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
//                    [
//                        'attribute' => 'name',
//                        'filterInputOptions' => [
//                            'class' => 'form-control input-rounded',
//                            'id' => null
//                        ],
//                    ],
                    'category',
                    [
                        'attribute' => 'description',
                        'value' => function ($searchModel) {
                            return $searchModel['description_'.Yii::$app->language];
                        },

                    ],
                    [
                        'attribute' =>   'updated_at',
                        'value' => function($searchModel){
                            return date('d.m.Y H:i:s', $searchModel->updated_at);
                        },

                    ],
                    //'updated_at',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}  {delete}',
                        'buttons' => [
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<span class="fa fa-trash"></span>', $url, [
                                    'title' => Yii::t('messages', 'Delete'),
                                    'data-confirm' => Yii::t('messages', 'Are you sure you want to delete?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '1',
                                    'class' => 'btn btn-xs btn-danger'
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="fa  fa-edit"></span>', $url, [
                                    'title' => Yii::t('messages', 'Edit'),
                                    'data-pjax' => '1',
                                    'class' => 'btn btn-xs btn-info'
                                ]);
                            },
                            'view' => function ($url, $model, $key) {
                                return Html::a('<span class="fa  fa-eye"></span>', $url, [
                                    'title' => Yii::t('messages', 'View'),
                                    'data-pjax' => '1',
                                    'class' => 'btn btn-xs btn-primary'
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>

