<?php

use app\modules\directory\models\InsDirectoryAppform;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$createUrl = \Yii::$app->urlManager->createUrl("/icase/ins-products-appform/create");

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsAppform */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-products-appform-form">

    <?php $form = ActiveForm::begin(['id' => 'ins-products-appform-form',
        'action' => '',
        'options' => [
            'class' => '',
            'data-pjax' => 1]
    ]); ?>
    <?= $form->field($model, 'id_ins_products')->hiddenInput(['value'=>$product])->label(false) ?>
    <?= $form->field($model, 'id_directory_appform')->dropDownList(ArrayHelper::map(InsDirectoryAppform::find()->all(), 'id', 'name_ru'), ['class' => 'form-control', 'prompt' => 'Выберите'])->label(); ?>
    <?= $form->field($model, 'id_directory_appform')->checkboxList(ArrayHelper::map(InsDirectoryAppform::find()->all(), 'id', 'name_ru'), ['class' => ''])->label(false); ?>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancel
        </button>
        <?php AjaxSubmitButton::begin([
            'label' => 'Save',
            'useWithActiveForm' => 'ins-products-appform-form',
            'ajaxOptions' => [
                'dataType' => 'json',
                'type' => 'POST',
                'url' => $createUrl,
                'success' => new \yii\web\JsExpression('function(html){
                        if(html.status == "success")
                         alert(html.code);
                         $("#modalAddAppform").modal("hide");
                         $("#ins-products-appform-form").each(function(){
                                this.reset();
                         });
                        }'),
            ],
            'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
        ]);
        AjaxSubmitButton::end();
        ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
