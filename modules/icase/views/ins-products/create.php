<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsProducts */

$this->title = Yii::t('messages', 'Create Ins Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-products-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
