<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryProductType */

$this->title = Yii::t('messages', 'Create {text}',[
    'text' => Yii::t('messages', 'Create Ins Directory Product Type')
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Create Ins Directory Product Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-product-type-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
