<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryDepartcodes */


$this->title = Yii::t('messages', 'Create {text}',[
        'text' => Yii::t('messages', 'Ins Directory Departcodes')
    ]) .": ". $model->id_department;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Departcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-departcodes-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
