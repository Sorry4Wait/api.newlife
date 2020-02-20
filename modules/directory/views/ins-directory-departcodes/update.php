<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryDepartcodes */


$this->title = Yii::t('messages', 'Update {text}',[
        'text' => Yii::t('messages', 'Ins Directory Departcodes')
    ]) .": ". $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Departcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id_department]];
$this->params['breadcrumbs'][] = Yii::t('messages', 'Update');
?>
<div class="ins-directory-departcodes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
