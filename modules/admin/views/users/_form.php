<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
//use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => false, 'class' => 'customAjaxForm', 'customAjaxForm-model' => 'admin-users'],
    ]); ?>

    <div class="row form-group">

        <div class="col-md-6">
            <?= $form->field($model, 'login')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>

        </div>
    </div>
    <div class="row form-group">

        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '', 'class' => ['form-control input-rounded']]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true, 'value' => '', 'class' => ['form-control input-rounded']]) ?>
        </div>
    </div>
    <div class="row form-group">

        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'current_position_id')->widget(Select2::classname(), [
                'data' => [1,3,4,5],
                'options' => ['placeholder' => Yii::t('messages', 'Select'), 'class' => 'col-md-6'],
                'size' => Select2::SIZE_SMALL,
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>

        </div>
    </div>

    <div class="row form-group">

        <div class="col-md-6">
            <?=
            $form->field($model, 'department_id')->widget(Select2::classname(), [
                'data' => [1,3,4,5],
                'options' => ['placeholder' => Yii::t('messages', 'Department'), 'class' => 'col-md-6'],
                'size' => Select2::SIZE_SMALL,
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>
        </div>
    </div>


    <?=
    $form->field($model, 'roles')->widget(Select2::classname(), [
        'data' => \app\modules\admin\models\AuthItem::getRoles(),
        'options' => ['placeholder' => Yii::t('messages', 'Select_Roles'), 'value' => $model->getPermissions($model->id), 'class' => 'col-md-6'],
        'size' => Select2::SIZE_SMALL,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]); ?>
    <div class="form-group">

        <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right']) ?>
        <button type="button" class="btn   mr-2 mb-1 btn-danger btn-rounded float-right btn-sm" data-dismiss="modal">
            <?php echo Yii::t('messages', 'Cancel'); ?>
        </button>
    </div>


    <?php ActiveForm::end(); ?>

</div>
