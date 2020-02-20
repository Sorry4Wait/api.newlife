<?php

use app\modules\icase\models\InsClassification;
use app\modules\icase\models\InsProductsClassification;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use app\modules\icase\models\InsProductsCalculation;
use app\modules\icase\models\InsProductsAppform;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsClassification */
/* @var $modelCalc app\modules\icase\models\InsProductsCalculation */
/* @var $searchModel app\modules\icase\models\InsProductsClassificationSearch */
/* @var $searchModelCalculation app\modules\icase\models\InsProductsCalculationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderCalculation yii\data\ActiveDataProvider */
/* @var $dataProviderAppform yii\data\ActiveDataProvider */

$this->title = 'Ins Products Classifications';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <ul id="detailTab" class="nav nav-tabs bordered tab-align-center">
        <li class="active">
            <a href="#s1" data-toggle="tab"><?php echo Yii::t('messages', 'Classification'); ?></i></a>
        </li>
        <li>
            <a href="#s2" data-toggle="tab"><?php echo Yii::t('messages', 'Product Calculation'); ?></a>
        </li>
        <li>
            <a href="#s3" data-toggle="tab"><?php echo Yii::t('messages', 'Application Form'); ?></a>
        </li>
    </ul>
    <div id="detailTabContent" class="tab-content padding-10">
        <div class="tab-pane fade in active" id="s1">
            <div class="ins-products-classification-index">

                <?php Pjax::begin(); ?>

                <p>
                    <?= Html::button(Yii::t('messages', 'Create'), ['id' => 'productClassificationBtn', 'class' => 'btn btn-success', 'onclick' => '(function ( $event ) { $("#modalAddClassification").modal(); })();']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'ins-products-classification-grid',
                    'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                    'striped'=> false,
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
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-2x fa-trash-o"></span>', $url, [
                                        'title' => Yii::t('messages', 'Delete'),
                                        'data-confirm' => 'Are you sure you want to delete?',
                                        'data-method' => 'post',
                                        'data-pjax' => '1',
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-2x fa-edit"></span>', $url, [
                                        'title' => Yii::t('messages', 'Edit'),
                                        'data-pjax' => '1',
                                    ]);
                                },
                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'update') {
                                    return \yii\helpers\Url::to(['ins-products-classification/update','id' => $model->id]);
                                }
                                if ($action === 'delete') {
                                    return \yii\helpers\Url::to(['ins-products-classification/delete','id' => $model->id]);
                                }

                            }
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
        <div class="tab-pane fade" id="s2">

            <div class="ins-products-calculation-index">

                <?php Pjax::begin(); ?>

                <p>
                    <?= Html::button(Yii::t('messages', 'Create'), ['id' => 'productCalculationBtn', 'class' => 'btn btn-success', 'onclick' => '(function ( $event ) { $("#modalAddCalculation").modal(); })();']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProviderCalculation,
                    'id' => 'ins-products-calculation-grid',
                    'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                    'striped'=> false,
                    'bordered' => false,
                    'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id', 'visible' => false],
                        [
                            'attribute' => 'id_calculation_type',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->calculationType->name_ru;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        'calculation_percentage',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-2x fa-trash-o"></span>', $url, [
                                        'title' => Yii::t('messages', 'Delete'),
                                        'data-confirm' => 'Are you sure you want to delete?',
                                        'data-method' => 'post',
                                        'data-pjax' => '1',
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-2x fa-edit"></span>', $url, [
                                        'title' => Yii::t('messages', 'Edit'),
                                        'data-pjax' => '1',
                                    ]);
                                },
                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'update') {
                                    return \yii\helpers\Url::to(['ins-products-calculation/update','id' => $model->id]);
                                }
                                if ($action === 'delete') {
                                    return \yii\helpers\Url::to(['ins-products-calculation/delete','id' => $model->id]);
                                }

                            }
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>

        </div>
        <div class="tab-pane fade" id="s3">

            <div class="ins-products-appform-index">

                <?php Pjax::begin(); ?>

                <p>
                    <?= Html::button(Yii::t('messages', 'Create'), ['id' => 'productAppformBtn', 'class' => 'btn btn-success', 'onclick' => '(function ( $event ) { $("#modalAddAppform").modal(); })();']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProviderAppform,
                    'id' => 'ins-products-appform-grid',
                    'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                    'striped'=> false,
                    'bordered' => false,
                    'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id', 'visible' => false],
                        [
                            'attribute' => 'id_directory_appform',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->directoryAppform->name_ru;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-2x fa-trash-o"></span>', $url, [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => 'Are you sure you want to delete?',
                                        'data-method' => 'post',
                                        'data-pjax' => '1',
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="fa fa-2x fa-edit"></span>', $url, [
                                        'title' => Yii::t('yii', 'Edit'),
                                        'data-pjax' => '1',
                                    ]);
                                },
                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'update') {
                                    return \yii\helpers\Url::to(['ins-products-appform/update','id' => $model->id]);
                                }
                                if ($action === 'delete') {
                                    return \yii\helpers\Url::to(['ins-products-appform/delete','id' => $model->id]);
                                }

                            }
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalAddClassification" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Product Classification</h4>
            </div>
            <div class="modal-body">
                <?=
                $this->renderAjax('_form', ['model' => new InsProductsClassification(), 'product' => $product]);
                ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<div class="modal fade" id="modalAddCalculation" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Product Calculation</h4>
            </div>
            <div class="modal-body">
                <?=
                $this->renderAjax('/ins-products-calculation/_form', ['model' => new InsProductsCalculation(), 'product' => $product]);
                ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<div class="modal fade" id="modalAddAppform" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Product Appform</h4>
            </div>
            <div class="modal-body">
                <?=
                $this->renderAjax('/ins-products-appform/_form', ['model' => new InsProductsAppform(), 'product' => $product]);
                ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
