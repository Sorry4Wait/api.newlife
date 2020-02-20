<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('messages', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary btn-rounded']) ?>
        <?= Html::a(Yii::t('messages', 'Delete'), ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger btn-rounded',
            'data' => [
                'confirm' => Yii::t('messages', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type',
           'description:ntext',
           'category',
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date('d.m.Y H:i:s', $model->created_at);
                },

            ],
            [
                'attribute' =>  'updated_at',
                'value' => function($model){
                    return date('d.m.Y H:i:s', $model->updated_at);
                },

            ],
        ],
    ]) ?>

    <?=
    Html::a(Yii::t('messages', 'Back'), $model->type !== 2 ? ['index'] : ['permissions'], ['class' => 'btn  mr-2 mb-1 btn-danger btn-rounded'])
    ?>

</div>
