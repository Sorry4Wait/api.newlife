<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsApphealthDeclarationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ins Apphealth Declarations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-apphealth-declaration-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Application Form', ['/icase/ins-appform-clients/application'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_appform',
            'chronic_disease',
            'def_chronic_disease',
            'disability',
            //'group_disability',
            //'couse_disability',
            //'old_disability',
            //'doctor_observations',
            //'inpatient_treatment',
            //'count_inpatient_treatment',
            //'placename_treatment',
            //'diagnosis_inpatient_treatment',
            //'l5_operation',
            //'cause_l5_operation',
            //'placename_l5_operation',
            //'date_completion',
            //'create_date',
            //'id_admin_users',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
