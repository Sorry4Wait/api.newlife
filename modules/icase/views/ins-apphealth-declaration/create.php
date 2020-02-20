<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsApphealthDeclaration */

$this->title = 'Create Ins Apphealth Declaration';
$this->params['breadcrumbs'][] = ['label' => 'Ins Apphealth Declarations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ins-apphealth-declaration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
