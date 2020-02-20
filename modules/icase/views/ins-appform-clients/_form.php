<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsAppform */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-products-appform-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ins_products')->textInput() ?>

    <?= $form->field($model, 'id_directory_appform')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
