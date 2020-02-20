<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProducts */

$this->title = Yii::t('messages', 'Update Ins Products: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('messages', 'Update');
?>
<div class="ins-products-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
