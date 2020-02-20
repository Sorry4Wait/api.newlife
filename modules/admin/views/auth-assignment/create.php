<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthAssignment */

$this->title = Yii::t('messages', 'Create Auth Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
