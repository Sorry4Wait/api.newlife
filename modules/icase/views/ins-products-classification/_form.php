<?php

use demogorgorn\ajax\AjaxSubmitButton;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\icase\models\InsClassification;
//use kartik\select2\Select2;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;

$createUrl = \Yii::$app->urlManager->createUrl("/icase/ins-products-classification/create");

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsClassification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'class' => 'customAjaxForm', 'customAjaxForm-model' => 'ins-products-classification'],
    ]); ?>

    <?= $form->field($model, 'ismain')->textInput() ?>

    <?php echo

    $form->field($model, 'id_classification')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(InsClassification::find()->all(), 'id', 'name'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <div class="form-group float-right">
            <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-success savePjaxBtn']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


