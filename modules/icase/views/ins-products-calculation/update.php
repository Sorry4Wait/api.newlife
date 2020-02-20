<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsCalculation */

$this->title = 'Update Ins Products Calculation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ins Products Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ins-products-calculation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
