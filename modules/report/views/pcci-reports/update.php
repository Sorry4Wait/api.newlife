<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\PcciReports */

$this->title = 'Update Pcci Reports: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pcci Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pcci-reports-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
