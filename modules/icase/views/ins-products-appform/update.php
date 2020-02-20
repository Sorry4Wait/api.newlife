<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsAppform */

$this->title = 'Update Ins Products Appform: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ins Products Appforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ins-products-appform-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
