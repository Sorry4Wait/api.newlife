<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryPrefix */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-directory-prefix-form">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'class' => 'customAjaxForm']]); ?>

    <?= $form->field($model, 'prefix')->textInput(['maxlength' => true]) ?>

    <div class="form-group float-right">
        <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right']) ?>
        <button type="button" class="btn   mr-2 mb-1 btn-danger btn-rounded float-right btn-sm" data-dismiss="modal">
            <?php echo Yii::t('messages', 'Cancel'); ?>
        </button>
    </div>
    <?php ActiveForm::end(); ?>

</div>
