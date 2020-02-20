<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryAppform */


$this->title = Yii::t('messages', 'Update {text}',[
        'text' => Yii::t('messages', 'Ins Directory Appform')
    ]) .": ". $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Appform'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('messages', 'Update');
?>
<div class="ins-directory-appform-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
