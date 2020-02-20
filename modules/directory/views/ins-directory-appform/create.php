<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryAppform */

$this->title = Yii::t('messages', 'Create {text}',[
        'text' => Yii::t('messages', 'Ins Directory Appform')
    ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Appform'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-appform-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
