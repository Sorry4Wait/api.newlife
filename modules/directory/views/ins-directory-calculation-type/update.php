<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryCalculationType */


$this->title = Yii::t('messages', 'Update {text}',[
        'text' => Yii::t('messages', 'Ins Directory Calculation Type')
    ]) .": ". $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Calculation Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ins-directory-calculation-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
