<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryProductKind */


$this->title = Yii::t('messages', 'Create {text}',[
        'text' => Yii::t('messages', 'Ins Directory Product Kind')
    ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Product Kind'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-product-kind-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
