<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsApphealthDeclarationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-apphealth-declaration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_appform') ?>

    <?= $form->field($model, 'chronic_disease') ?>

    <?= $form->field($model, 'def_chronic_disease') ?>

    <?= $form->field($model, 'disability') ?>

    <?php // echo $form->field($model, 'group_disability') ?>

    <?php // echo $form->field($model, 'couse_disability') ?>

    <?php // echo $form->field($model, 'old_disability') ?>

    <?php // echo $form->field($model, 'doctor_observations') ?>

    <?php // echo $form->field($model, 'inpatient_treatment') ?>

    <?php // echo $form->field($model, 'count_inpatient_treatment') ?>

    <?php // echo $form->field($model, 'placename_treatment') ?>

    <?php // echo $form->field($model, 'diagnosis_inpatient_treatment') ?>

    <?php // echo $form->field($model, 'l5_operation') ?>

    <?php // echo $form->field($model, 'cause_l5_operation') ?>

    <?php // echo $form->field($model, 'placename_l5_operation') ?>

    <?php // echo $form->field($model, 'date_completion') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'id_admin_users') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
