<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\PcciReportsLink */
/* @var $form yii\widgets\ActiveForm */
$upload = \Yii::$app->urlManager->createUrl("/report/pcci-reports-link/upload");
?>

<?php $form = ActiveForm::begin([
    'id' => 'pcci-reports-link-form',
    'action' => $upload,
    'options' => [
        'class' => 'smart-form',
        'enctype' => 'multipart/form-data'
    ],
]); ?>

<fieldset>
    <section>
        <div class="row">
            <label class="label col col-2">File</label>
            <div class="col col-10">
                <label class="input"> <i class="icon-append fa fa-upload"></i>
                    <?= $form->field($model, 'link')->fileInput()->label(false) ?>
                </label>
            </div>
        </div>
    </section>

</fieldset>

<?= $form->field($model, 'reports_id')->hiddenInput()->label(false) ?>
<footer>
    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'name' => 'upload-button']) ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">
        Cancel
    </button>
</footer>

<?php ActiveForm::end(); ?>

