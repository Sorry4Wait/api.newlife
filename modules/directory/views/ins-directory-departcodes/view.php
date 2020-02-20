<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\directory\models\InsDirectoryDepartcodes */

$this->title = $model->id_department;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Directory Departcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ins-directory-departcodes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('messages', 'Update'), ['update', 'id' => $model->id_department], ['class' => 'btn btn-primary btn-rounded']) ?>
        <?= Html::a(Yii::t('messages', 'Delete'), ['delete', 'id' => $model->id_department], [
            'class' => 'btn btn-danger btn-rounded',
            'data' => [
                'confirm' => Yii::t('messages',  'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_department',
            'code',
        ],
    ]) ?>
    <?=
    Html::a(Yii::t('messages', 'Back'), ['index'] , ['class' => 'btn  mr-2 mb-1 btn-danger btn-rounded'])
    ?>

</div>
