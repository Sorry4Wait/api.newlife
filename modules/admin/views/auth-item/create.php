<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */

$this->title = Yii::t('messages', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <?= $this->render('_form', [
        'model' => $model,
        'perms' => $perms,
        'parents' => $parents,
    ]) ?>

</div>
