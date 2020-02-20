<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryPrefix */


$this->title = Yii::t('messages', 'Create {text}',[
        'text' => Yii::t('messages', 'Ins Directory Prefix')
    ]) .": ". $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Prefix'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-prefix-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
