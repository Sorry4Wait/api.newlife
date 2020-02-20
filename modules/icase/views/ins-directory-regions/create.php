<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsDirectoryRegions */

$this->title = Yii::t('messages', 'Create Ins Directory Regions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-regions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
