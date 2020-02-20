<?php

use app\modules\directory\models\InsDirectoryCalculationType;
use app\modules\directory\models\InsDirectoryProductType;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;

$createUrl = \Yii::$app->urlManager->createUrl("/icase/ins-products-calculation/create");


/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsCalculation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'class' => 'customAjaxForm', 'customAjaxForm-model' => 'ins-products-calculation']]); ?>
    <?= $form->field($model, 'id_products')->hiddenInput(['value'=>$product])->label(false) ?>
    <?= $form->field($model, 'id_calculation_type')->dropDownList(ArrayHelper::map(InsDirectoryCalculationType::find()->all(), 'id', 'name_ru'), ['class' => 'form-control', 'prompt' => 'Выберите'])->label(); ?>
    <?= $form->field($model, 'calculation_percentage')->textInput() ?>

    <div class="form-group">
        <div class="form-group float-right">
            <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
