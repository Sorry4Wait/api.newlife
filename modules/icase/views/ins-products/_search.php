<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_uz') ?>

    <?= $form->field($model, 'name_ru') ?>

    <?= $form->field($model, 'id_product_type') ?>

    <?= $form->field($model, 'id_product_kind') ?>

    <?php // echo $form->field($model, 'who_create') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'who_approve') ?>

    <?php // echo $form->field($model, 'date_approve') ?>

    <?php // echo $form->field($model, 'id_product_status') ?>

    <?php // echo $form->field($model, 'id_product_prefix') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'un_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('messages', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('messages', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
