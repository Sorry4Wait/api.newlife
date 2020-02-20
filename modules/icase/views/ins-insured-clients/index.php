<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsInsuredClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Ins Insured Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="col col-sm-8 float-md-right">
                <?= Html::a(Yii::t('messages', 'Add New') . '<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>', '#', ['class' => 'btn  mb-1 gradient-1 btn-rounded float-right create-ins-insured-clients', 'id' => 'productButton']) ?>
            </div>
        </div>
        <hr>
        <div class="table-responsive">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php Pjax::begin(['id' => 'ins-insured-clients_pjax']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
               // 'filterModel' => $searchModel,
                'layout' => '{items}<div class=\'float-right\'>{pager}</div>',
                'striped'=> false,
                'bordered' => false,
                'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'document',
                    'pinpp',
                  //  'lang_id',
                    'name_latin',
                    'surname_latin',
                    'patronym_latin',
                    'name_engl',
                    'surname_engl',
                    'birth_date',
                    //'birth_place',
                    //'birth_place_id',
                    //'birth_country',
                    //'birth_country_id',
                    //'livestatus',
                    //'nationality',
                    //'nationality_id',
                    //'citizenship',
                    //'citizenship_id',
                    //'sex',
                    //'doc_give_place',
                    //'doc_give_place_id',
                    //'date_begin_document',
                    //'date_end_document',
                    //'inn',
                    //'who_registred',
                    //'create_date',
                    //'address',
                    //'phone',
                    //'email:email',
                    //'citizen_status',
                    //'work_place',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>


        </div>

    </div>
</div>

<?= \app\widgets\ModalWindow\ModalWindow::widget([
    'model' => 'ins-insured-clients',
    'modal_id' => 'ins-insured-clients-modal',
    'controller' => 'ins-insured-clients',
    'modal_header' => Yii::t('messages','Ins Insured Clients'),
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-ins-insured-clients',
    'create_button' => 'create-ins-insured-clients',
    'delete_button' => 'delete-ins-insured-clients',
    'modal_size' => 'modal-lg',
    'grid_ajax' => 'ins-insured-clients_pjax',
    'confirm_message' => Yii::t('app', 'Haqiqatan ham ushbu mahsulotni yo\'q qilmoqchimisiz?')
]); ?>

