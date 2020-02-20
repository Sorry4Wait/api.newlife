<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\directory\models\DirectoryDepartments;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\PcciReports */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="pcci-reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->dropDownList(DirectoryDepartments::getDepartments(), ['prompt' => 'Выберите'])->label(); ?>

    <?= $form->field($model, 'report_name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
