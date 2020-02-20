<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsInsuredClients */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Ins Insured Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ins-insured-clients-view">

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
            'document',
            'pinpp',
            'lang_id',
            'name_latin',
            'surname_latin',
            'patronym_latin',
            'name_engl',
            'surname_engl',
            'birth_date',
            'birth_place',
            'birth_place_id',
            'birth_country',
            'birth_country_id',
            'livestatus',
            'nationality',
            'nationality_id',
            'citizenship',
            'citizenship_id',
            'sex',
            'doc_give_place',
            'doc_give_place_id',
            'date_begin_document',
            'date_end_document',
            'inn',
            'who_registred',
            'create_date',
            'address',
            'phone',
            'email:email',
            'citizen_status',
            'work_place',
        ],
    ]) ?>

</div>
