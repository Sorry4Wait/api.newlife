<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use yii2mod\editable\EditableColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Ins Products');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="col col-sm-8 float-md-right">
                <?= Html::a(Yii::t('messages','Add New').'<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>',['create'],['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right create-ins-products','id' => 'productButton'])?>
            </div>
        </div>
        <hr>
        <div class="table-responsive">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php Pjax::begin(['id' => 'ins-products_pjax']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                'striped'=> false,
                'bordered' => false,
                'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name_uz',
                    'name_ru',
                    [
                        'attribute' => 'id_product_type',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $column) {
                            $data = $model->productType->name_ru;
                            if (empty($data)) {
                                return null;
                            } else {
                                return  $data;
                            }
                        },
                    ],
                    [
                        'attribute' => 'id_product_kind',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $column) {
                            $data = $model->productKind->name_ru;
                            if (empty($data)) {
                                return null;
                            } else {
                                return  $data;
                            }
                        },
                    ],
                    [
                        'attribute' => 'id_product_prefix',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $column) {
                            $data = $model->productPrefix->prefix;
                            if (empty($data)) {
                                return null;
                            } else {
                                return $data;
                            }
                        },
                    ],
                    [
                        'attribute' => 'id_product_status',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $column) {
                            $data = $model->productStatus->name_ru;
                            if (empty($data)) {
                                return null;
                            } else {
                                return  $data;
                            }
                        },
                    ],
//                    [
//                        'class' => EditableColumn::class,
//                        'attribute' => 'id_product_status',
//                        'url' => ['change-status'],
//                        'type' => 'select',
//                        'value' => function ($model) {
//                            $class = $model->id_product_status == 1 ? 'btn btn-xs btn-success' : 'btn btn-xs btn-danger';
//                            return Html::button($model->productStatus->name_ru, ['class' => $class]);
//                        },
//                       // 'filter' => $searchModel->getStatusList(),
//                        'editableOptions' => function ($model) {
//                            return [
//                                'source' => $model->statusList,
//                                'value' => $model->id_product_status,
//                                'id' => $model->id,
//                            ];
//                        },
//                        'clientOptions' => [
//
//                            'display' => (new \yii\web\JsExpression("function(res, newVal) {
//                            return false;
//                        }")),
//
//                            'success' => (new \yii\web\JsExpression("function(res, newVal) {
//                            if(res.success) {
//                                $('a[data-pk=' + res.id + ']').html(res.btn);
//                            }
//                        }"))
//                        ],
//                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'contentOptions' => ['width' => '10%'],
                        'buttons' => [
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<span class="fa fa-trash"></span>', $url, [
                                    'title' => Yii::t('messages', 'Delete'),
                                    'data-method' => 'post',
                                    'data-pjax' => '1',
                                    'data-form-id' => $model->id,
                                    'data-confirm-message' =>Yii::t('messages', 'Are you sure you want to delete?'),
                                    'class' => 'btn btn-xs btn-danger delete-ins-products'
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="fa  fa-edit"></span>', $url, [
                                    'title' => Yii::t('messages', 'Edit'),
                                    'data-pjax' => '1',
                                    'data-form-id' => $model->id,
                                    'class' => 'btn btn-xs btn-info'
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                return Url::to(['detail-view', 'id' => $model->id]);
                            }
                            if ($action === 'delete') {
                                return "#";
                            }
                        }
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>


        </div>

    </div>
</div>

<?= \app\widgets\ModalWindow\ModalWindow::widget([
    'model' => 'ins-products',
    'modal_id' => 'ins-products-modal',
    'controller' => 'ins-products',
    'modal_header' => Yii::t('messages','Ins Products'),
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-ins-products',
    'create_button' => 'create-ins-products',
    'delete_button' => 'delete-ins-products',
    'modal_size' => 'modal-md',
    'grid_ajax' => 'ins-products_pjax',
    'confirm_message' => Yii::t('app', 'Haqiqatan ham ushbu mahsulotni yo\'q qilmoqchimisiz?')
]); ?>


