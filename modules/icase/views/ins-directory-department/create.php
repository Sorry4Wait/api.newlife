<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsDirectoryDepartment */

$this->title = Yii::t('messages', 'Create Ins Directory Department');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-directory-department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
