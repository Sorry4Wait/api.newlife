<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsInsuredClients */

$this->title = Yii::t('messages', 'Create Ins Insured Clients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Insured Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-insured-clients-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
