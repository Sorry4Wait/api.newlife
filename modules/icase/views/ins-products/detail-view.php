<?php
/**
 * @var $model app\modules\icase\models\InsProducts
 */

use app\assets\AppAsset;
use kartik\detail\DetailView;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$attributes = [
    [
        'columns' => [
            [
                'attribute' => 'un_code',
                'value' => $model->un_code,
                'displayOnly' => true,
                'valueColOptions' => ['style' => 'width:30%']
            ],
            [
                'attribute' => 'id_product_status',
                'format' => 'raw',
                'value' => '<span class="badge badge-success text-justify"><em>' . $model->productStatus->name_ru . '</em></span>',
                'type' => DetailView::INPUT_SWITCH,
                'options' => ['rows' => 4]
            ]
        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'name_ru',
                'format' => 'raw',
                'value' => '<kbd>' . $model->name_ru . '</kbd>',
                'valueColOptions' => ['style' => 'width:30%'],
                'displayOnly' => true
            ],
            [
                'attribute' => 'name_uz',
                'format' => 'raw',
                'value' => '<kbd>' . $model->name_uz . '</kbd>',
                'valueColOptions' => ['style' => 'width:30%'],
                'displayOnly' => true
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'id_product_type',
                'format' => 'raw',
                'value' => '<span class="badge badge-success">' . $model->productType->name_ru . '</span>',
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
            [
                'attribute' => 'id_product_kind',
                'format' => 'raw',
                'value' => '<span class="badge badge-success">' . $model->productKind->name_ru . '</span>',
                'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],

        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'date_create',
                //'format' => 'date',
                'value' => date('Y-m-d H:i:s', strtotime($model->date_create)),
                'type' => DetailView::INPUT_DATE,
                'valueColOptions' => ['style' => 'width:30%']
            ],
            [
                'attribute' => 'date_approve',
                'format' => 'raw',
                'value' => Html::a(Yii::$app->user->identity['fullName'], '#', ['class' => 'kv-author-link']) . " - " . date('Y-m-d H:i:s', strtotime($model->date_approve)),
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    //'data'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                ],
                'valueColOptions' => ['style' => 'width:30%']
            ],
        ]
    ],

];

?>

<div class="card">
    <?php Pjax::begin(['id' => 'ins-products-detail-view_pjax']); ?>
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h4 class="text-center"><?= $model['name_' . Yii::$app->language]; ?></h4>
            </div>
            <div class="col col-sm-8">
            </div>
        </div>

        <?= // View file rendering the widget
        DetailView::widget([
            'model' => $model,
            'attributes' => $attributes,
            'mode' => 'view',
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,

            'deleteOptions' => [ // your ajax delete parameters
                'params' => ['id' => 1000, 'kvdelete' => true],
            ],
            'container' => ['id' => 'kv-demo'],
            'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
        ]);
        ?>

    </div>
    <?php Pjax::end(); ?>
</div>


<div class="custom-tab-1">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                href="#tab1"><?php echo Yii::t('messages', 'Classification'); ?></a>
        </li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                href="#tab2"><?php echo Yii::t('messages', 'Product Calculation'); ?></a>
        </li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                href="#tab3"><?php echo Yii::t('messages', 'Application Form'); ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active card" id="tab1" role="tabpanel">
            <?php Pjax::begin(['id' => 'ins-products-classification_pjax']); ?>
            <div class="table-responsive card-body">
                <div class="card-header row">
                    <div class="col col-sm-4">
                        <h3><?php echo Yii::t('messages', 'Classification'); ?></h3>
                    </div>

                    <div class="col col-sm-8 float-md-right">
                        <?= Html::a(Yii::t('messages', 'Add New') . '<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>', null, [
                            'class' => 'btn mb-1 gradient-1 btn-rounded float-right openModalWindow',
                            'href' => 'javascript:void(0);',
                            'value' => Url::to(['ins-products-classification/create', 'id' => $model->id]),
                            'data-action-type' => 'create',
                        ]) ?>
                    </div>
                </div>
                <hr>
                <div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderInsProdClass,
                        //'filterModel' => $searchModelInsProdClass,
                        'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                        'striped' => false,
                        'bordered' => false,
                        'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                                'attribute' => 'id_classification',
                                'value' => function ($model, $key, $index, $column) {
                                    $data = $model->classification->name;
                                    if (empty($data)) {
                                        return null;
                                    } else {
                                        return $data;
                                    }
                                },
                            ],
                            [
                                'attribute' => 'ismain',
                                'value' => function ($model, $key, $index, $column) {
                                    return $model->ismain == 1 ? "Главная" : "";
                                },
                            ],

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'contentOptions' => ['width' => '10%'],
                                'buttons' => [
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<span class="fa fa-trash"></span>', 'javascript:void(0);', [
                                            'title' => Yii::t('messages', 'Delete'),
                                            'data-method' => 'post',
                                            'data-pjax' => '1',
                                            'data-form-id' => $model->id,
                                            'value' => Url::to(['ins-products-classification/delete', 'id' => $model->id]),
                                            'data-form-model' => 'ins-products-classification',
                                            'data-confirm-message' => Yii::t('messages', 'Are you sure you want to delete?'),
                                            'class' => 'btn btn-xs btn-danger delete-model'
                                        ]);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('<span class="fa  fa-edit"></span>', 'javascript:void(0);', [
                                            'title' => Yii::t('messages', 'Edit'),
                                            'data-pjax' => '1',
                                            'data-form-id' => $model->id,
                                            'class' => 'btn btn-xs btn-info update-ins-class'
                                        ]);
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>

            </div>
            <?php Pjax::end(); ?>
        </div>
        <div class="tab-pane fade card" id="tab2">
            <?php Pjax::begin(['id' => 'ins-products-calculation_pjax']); ?>
            <div class="table-responsive card-body">
                <div class="card-header row">
                    <div class="col col-sm-4">
                        <h3><?php echo Yii::t('messages', 'Product Calculation'); ?></h3>
                    </div>

                    <div class="col col-sm-8 float-md-right">
                        <?= Html::a(Yii::t('messages', 'Add New') . '<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>', null, [
                            'class' => 'btn mb-1 gradient-1 btn-rounded float-right openModalWindow',
                            'href' => 'javascript:void(0);',
                            'value' => Url::to(['ins-products-calculation/create', 'id' => $model->id]),
                            'data-action-type' => 'create',
                        ]) ?>
                    </div>
                </div>
                <hr>
                <div>

                    <?= GridView::widget(['dataProvider' => $dataProviderCalculation,
                        //'filterModel' => $searchModelCalculation,
                        'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                        'striped' => false,
                        'bordered' => false,
                        'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                        'columns' => [['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            ['attribute' => 'id_calculation_type',
                                'value' => function ($model, $key, $index, $column) {
                                    $data = $model->calculationType->name_ru;
                                    if (empty($data)) {
                                        return null;
                                    } else {
                                        return $data;
                                    }
                                },],
                            'calculation_percentage',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'contentOptions' => ['width' => '10%'],
                                'buttons' => ['delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-trash"></span>', $url, ['title' => Yii::t('messages', 'Delete'),
                                        'data-method' => 'post',
                                        'data-pjax' => '1',
                                        'data-form-id' => $model->id,
                                        'value' => Url::to(['ins-products-calculation/delete', 'id' => $model->id]),
                                        'data-form-model' => 'ins-products-calculation',
                                        'data-confirm-message' => Yii::t('messages', 'Are you sure you want to delete?'),
                                        'class' => 'btn btn-xs btn-danger delete-model',]);
                                },
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('<span class="fa  fa-edit"></span>', $url, ['title' => Yii::t('messages', 'Edit'),
                                            'data-pjax' => '1',
                                            'data-form-id' => $model->id,
                                            'class' => 'btn btn-xs btn-info update-ins-calc',]);
                                    },
                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'update') {
                                        return '#';
                                    }
                                    if ($action === 'delete') {
                                        return 'javascript:void(0);';
                                    }
                                }
                            ],
                        ],
                    ]); ?>

                </div>

            </div>
            <?php Pjax::end(); ?>
        </div>
        <div class="tab-pane fade card" id="tab3">
            <?php Pjax::begin(['id' => 'ins-products-appform_pjax']); ?>
            <div class="p-t-15 card-body">
                <div class="card-header row">
                    <div class="col col-sm-4">
                        <h3><?php echo Yii::t('messages', 'Application Form'); ?></h3>
                    </div>

                    <div class="col col-sm-8 float-md-right">
                        <?= Html::a(Yii::t('messages', 'Add New') . '<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>', null, [
                            'class' => 'btn mb-1 gradient-1 btn-rounded float-right openModalWindow',
                            'href' => 'javascript:void(0);',
                            'value' => Url::to(['ins-products-appform/create', 'id' => $model->id]),
                            'data-form-model' => 'ins-products-appform',
                            'data-action-type' => 'create',
                        ]) ?>
                    </div>
                </div>
                <hr>
                <div>
                    <?= GridView::widget(['dataProvider' => $dataProviderAppform,
                        //'filterModel' => $searchModelAppform,
                        'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                        'striped' => false,
                        'bordered' => false,
                        'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                        'columns' => [['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            ['attribute' => 'id_directory_appform',
                                'value' => function ($model, $key, $index, $column) {
                                    $data = $model->directoryAppform->name_ru;
                                    if (empty($data)) {
                                        return null;
                                    } else {
                                        return $data;
                                    }
                                },],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'contentOptions' => ['width' => '10%'],
                                'buttons' => ['delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-trash"></span>', $url, ['title' => Yii::t('messages', 'Delete'),
                                        'data-method' => 'post',
                                        'data-pjax' => '1',
                                        'data-form-id' => $model->id,
                                        'value' => Url::to(['ins-products-appform/delete', 'id' => $model->id]),
                                        'data-form-model' => 'ins-products-appform',
                                        'data-confirm-message' => Yii::t('messages', 'Are you sure you want to delete?'),
                                        'class' => 'btn btn-xs btn-danger delete-model']);
                                },
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('<span class="fa  fa-edit"></span>', $url, ['title' => Yii::t('messages', 'Edit'),
                                            'data-pjax' => '1',
                                            'data-form-id' => $model->id,
                                            'class' => 'btn btn-xs btn-info update-ins-app-form']);
                                    },
                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'update') {
                                        return '#';
                                    }
                                    if ($action === 'delete') {
                                        return '#';
                                    }
                                }
                            ],
                        ],
                    ]); ?>
                </div>

            </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<?php Modal::begin(['id' => 'modalWindow',
    'title' => Yii::t('messages', 'New'),
    'size' => 'modal-md',]); ?>

<?php Modal::end();
?>

<?php

$this->registerJsFile(
    Yii::$app->request->baseUrl . '/js/multi-modals/multi-modals.js',
    ['depends' => [AppAsset::className()]]
);
?>







