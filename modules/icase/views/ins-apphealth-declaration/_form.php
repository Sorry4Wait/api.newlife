<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsApphealthDeclaration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-apphealth-declaration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_appform')->textInput() ?>

    <?= $form->field($model, 'chronic_disease')->textInput() ?>

    <?= $form->field($model, 'def_chronic_disease')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disability')->textInput() ?>

    <?= $form->field($model, 'group_disability')->textInput() ?>

    <?= $form->field($model, 'couse_disability')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_disability')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctor_observations')->textInput() ?>

    <?= $form->field($model, 'inpatient_treatment')->textInput() ?>

    <?= $form->field($model, 'count_inpatient_treatment')->textInput() ?>

    <?= $form->field($model, 'placename_treatment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnosis_inpatient_treatment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'l5_operation')->textInput() ?>

    <?= $form->field($model, 'cause_l5_operation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placename_l5_operation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_completion')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'id_admin_users')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
