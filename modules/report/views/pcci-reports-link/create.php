<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\PcciReportsLink */

$this->title = 'Create Pcci Reports Link';
$this->params['breadcrumbs'][] = ['label' => 'Pcci Reports Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcci-reports-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
