<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryCalculationType */


$this->title = Yii::t('messages', 'Create {text}',[
        'text' => Yii::t('messages', 'Ins Directory Calculation Type')
    ]) .": ". $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Calculation Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-calculation-type-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
