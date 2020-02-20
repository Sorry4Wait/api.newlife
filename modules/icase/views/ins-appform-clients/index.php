<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsAppformClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h3><?php echo Yii::t('messages', $this->title); ?></h3>
            </div>

            <div class="col col-sm-8 float-md-right">
                <?= Html::a(Yii::t('messages','Add New').'<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>',['/icase/ins-appform-clients/application'],['class' => 'btn mb-1 gradient-1 btn-rounded float-right'])?>
            </div>
            <div class="table-responsive">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'layout' => '{items}{pager}',
                    'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'id',
                            'visible' => false
                        ],
                        [
                            'attribute' => 'id_insured_clients',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->insuredClients->surname_latin . ' ' . $model->insuredClients->name_latin;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        [
                            'attribute' => 'id_insurer_clients',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->insuredClients->surname_latin . ' ' . $model->insuredClients->name_latin;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        [
                            'attribute' => 'id_beneficiary',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->insuredClients->surname_latin . ' ' . $model->insuredClients->name_latin;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        [
                            'attribute' => 'sms_notification',
                            'value' => function ($model, $key, $index, $column) {
                                return $model->sms_notification == 1 ? "Да" : "Нет";
                            },
                        ],
                        'first_downpayment_date',
                        'insurance_fee',
                        [
                            'attribute' => 'id_payment_procedure',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->paymentProcedure->name_ru;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        [
                            'attribute' => 'create_date',
                            'value' => function ($model, $key, $index, $column) {
                                return date('Y-m-d H:i:s',strtotime($model->create_date));
                            },
                        ],
                        [
                            'attribute' => 'id_products',
                            'value' => function ($model, $key, $index, $column) {
                                $data = $model->products->name_ru;
                                if (empty($data)) {
                                    return null;
                                } else {
                                    return $data;
                                }
                            },
                        ],
                        'app_status',

//            ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>

        </div>
    </div>
</div>


