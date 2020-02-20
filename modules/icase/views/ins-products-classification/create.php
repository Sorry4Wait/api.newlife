<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsClassification */

$this->title = 'Create Ins Products Classification';
$this->params['breadcrumbs'][] = ['label' => 'Ins Products Classifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-products-classification-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
