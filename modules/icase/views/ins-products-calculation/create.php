<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsCalculation */

$this->title = 'Create Ins Products Calculation';
$this->params['breadcrumbs'][] = ['label' => 'Ins Products Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-products-calculation-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
