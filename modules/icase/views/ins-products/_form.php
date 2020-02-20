<?php

use app\modules\directory\models\InsDirectoryProductType;
use app\modules\directory\models\InsDirectoryProductKind;
use app\modules\directory\models\InsDirectoryPrefix;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;

$createUrl = \Yii::$app->urlManager->createUrl("/icase/ins-products/create");
/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true, 'class' => 'customAjaxForm']]); ?>
<section>
    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
</section>
<section>
    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
</section>
<div class="row">
    <section class="col col-6">
        <?= $form->field($model, 'id_product_type')->dropDownList(InsDirectoryProductType::getProductTypes(), ['class' => 'form-control', 'prompt' => 'Выберите'])->label(); ?>
    </section>
    <section class="col col-6">
        <?= $form->field($model, 'id_product_kind')->dropDownList(InsDirectoryProductKind::getProductKinds(), ['class' => 'form-control', 'prompt' => 'Выберите'])->label(); ?>
    </section>
</div>
<div class="row">
    <section class="col col-6">
        <?= $form->field($model, 'id_product_prefix')->dropDownList(ArrayHelper::map(InsDirectoryPrefix::find()->all(), 'id', 'prefix'), ['class' => 'form-control', 'prompt' => 'Выберите'])->label(); ?>
    </section>
    <section class="col col-6">
        <?= $form->field($model, 'un_code')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </section>
</div>
<section>
    <?= $form->field($model, 'description')->textarea() ?>
</section>

<div class="form-group">

    <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right']) ?>
    <button type="button" class="btn   mr-2 mb-1 btn-danger btn-rounded float-right btn-sm" data-dismiss="modal">
        <?php echo Yii::t('messages', 'Cancel'); ?>
    </button>
</div>


<?php ActiveForm::end(); ?>



