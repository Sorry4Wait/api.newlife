<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsApphealthDeclaration */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ins Apphealth Declarations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ins-apphealth-declaration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_appform',
            'chronic_disease',
            'def_chronic_disease',
            'disability',
            'group_disability',
            'couse_disability',
            'old_disability',
            'doctor_observations',
            'inpatient_treatment',
            'count_inpatient_treatment',
            'placename_treatment',
            'diagnosis_inpatient_treatment',
            'l5_operation',
            'cause_l5_operation',
            'placename_l5_operation',
            'date_completion',
            'create_date',
            'id_admin_users',
        ],
    ]) ?>

</div>
