<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsDirectoryDepartment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-4">
            <?= $form->field($node,'region_id')->dropDownList($node->gerRegionList()) ?>
    </div>
    <div class="col-sm-8">
        <?= $form->field($node,'name_ru')->textInput(); ?>
    </div>
</div>
