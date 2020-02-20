<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsDirectoryDepartmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ins-directory-department-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'root') ?>

    <?= $form->field($model, 'lft') ?>

    <?= $form->field($model, 'rgt') ?>

    <?= $form->field($model, 'lvl') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'icon_type') ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <?php // echo $form->field($model, 'selected')->checkbox() ?>

    <?php // echo $form->field($model, 'disabled')->checkbox() ?>

    <?php // echo $form->field($model, 'readonly')->checkbox() ?>

    <?php // echo $form->field($model, 'visible')->checkbox() ?>

    <?php // echo $form->field($model, 'collapsed')->checkbox() ?>

    <?php // echo $form->field($model, 'movable_u')->checkbox() ?>

    <?php // echo $form->field($model, 'movable_d')->checkbox() ?>

    <?php // echo $form->field($model, 'movable_l')->checkbox() ?>

    <?php // echo $form->field($model, 'movable_r')->checkbox() ?>

    <?php // echo $form->field($model, 'removable')->checkbox() ?>

    <?php // echo $form->field($model, 'removable_all')->checkbox() ?>

    <?php // echo $form->field($model, 'child_allowed')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('messages', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('messages', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
