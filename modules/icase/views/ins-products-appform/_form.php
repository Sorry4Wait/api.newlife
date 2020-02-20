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

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'class' => 'customAjaxForm', 'customAjaxForm-model' => 'ins-products-appform']]); ?>
    <?= $form->field($model, 'id_directory_appform')->checkboxList(ArrayHelper::map(InsDirectoryAppform::find()->all(), 'id', 'name_ru'), ['separator' => '<br>', 'class'=>''])->label(false); ?>


    <div class="form-group">
        <div class="form-group float-right">
            <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
