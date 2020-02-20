<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\directory\models\InsDirectoryProductTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Type of Product');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="col col-sm-8 float-md-right">
                <?= Html::a(Yii::t('messages', 'Add New') . '<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>', ['create'], ['class' => 'btn  mb-1 gradient-1 btn-rounded float-right create-widget btn-sm', 'id' => 'productButton']) ?>
            </div>
        </div>
        <hr>
        <div class="ins-directory-product-type-index">
            <?php Pjax::begin(['id' =>'ins_directory_product_type_pjax']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                'striped'=> false,
                'bordered' => false,
                'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'id',
                        'visible' => false
                    ],
                    'namu_uz',
                    'name_ru',
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
                                    'data-confirm-message' => Yii::t('messages', 'Are you sure you want to delete?'),
                                    'class' => 'btn btn-xs btn-danger delete-widget'
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="fa  fa-edit"></span>', $url, [
                                    'title' => Yii::t('messages', 'Edit'),
                                    'data-pjax' => '1',
                                    'data-form-id' => $model->id,
                                    'class' => 'btn btn-xs btn-info update-widget'
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                return "#";
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
    'model' => 'ins-directory-product-type',
    'modal_id' => 'ins-directory-product-type-modal',
    'controller' => 'ins-directory-product-type',
    'modal_header' => Yii::t('messages', 'Type of Product'),
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-widget',
    'create_button' => 'create-widget',
    'delete_button' => 'delete-widget',
    'modal_size' => 'modal-md',
    'grid_ajax' => 'ins_directory_product_type_pjax',
    'confirm_message' => Yii::t('app', 'Haqiqatan ham ushbu mahsulotni yo\'q qilmoqchimisiz?')
]); ?>
