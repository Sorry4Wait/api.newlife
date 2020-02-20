<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryCalculationType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-directory-calculation-type-form">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'class' => 'customAjaxForm']]); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_product_type')->widget(Select2::classname(), [
        'data' =>[1 => 'Физическое лицо', 2 => 'Юридическое лицо'],
        'language' => 'ru',
        'size' => Select2::SIZE_SMALL,
        'options' => ['placeholder' => Yii::t('messages','Select')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group float-right">
        <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right']) ?>
        <button type="button" class="btn   mr-2 mb-1 btn-danger btn-rounded float-right btn-sm" data-dismiss="modal">
            <?php echo Yii::t('messages', 'Cancel'); ?>
        </button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
