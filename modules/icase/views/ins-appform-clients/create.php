<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProductsAppform */

$this->title = 'Create Ins Products Appform';
$this->params['breadcrumbs'][] = ['label' => 'Ins Products Appforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-products-appform-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
