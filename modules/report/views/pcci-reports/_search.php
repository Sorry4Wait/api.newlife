<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\directory\models\DirectoryDepartments;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\PcciReportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="row">
        <div class="pcci-reports-search col-xs-12">

            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1,
                    'class' => 'smart-form',
                ],

            ]); ?>

            <label class="select">
                <?=
                $form->field($model, 'department_id')->dropDownList(DirectoryDepartments::getDepartments(), ['prompt' => 'Выберите'])->label(false);
                ?>
                <i></i>
            </label>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
<br>
<?php
$this->registerJS(
    '$(function () {
        $("#pccireportssearch-department_id").change(function () {
            this.form.submit();
        });
    })');
?>