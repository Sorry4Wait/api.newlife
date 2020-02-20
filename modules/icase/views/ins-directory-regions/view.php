<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsDirectoryRegions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ins-directory-regions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('messages', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('messages', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('messages', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'root',
            'lft',
            'rgt',
            'lvl',
            'name',
            'icon',
            'icon_type',
            'active:boolean',
            'selected:boolean',
            'disabled:boolean',
            'readonly:boolean',
            'visible:boolean',
            'collapsed:boolean',
            'movable_u:boolean',
            'movable_d:boolean',
            'movable_l:boolean',
            'movable_r:boolean',
            'removable:boolean',
            'removable_all:boolean',
            'child_allowed:boolean',
        ],
    ]) ?>

</div>
