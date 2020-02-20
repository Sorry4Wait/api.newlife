<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsProductsAppformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messages', 'Ins Products Appforms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-body">
    <div class="card-header row">
        <div class="col col-sm-4">
            <h3><?php echo Yii::t('messages', $this->title); ?></h3>
        </div>

        <div class="col col-sm-8 float-md-right">
            <?= Html::a(Yii::t('messages','Add New').'<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>',['create'],['class' => 'btn mb-1 btn-success btn-rounded float-right'])?>
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'layout' => '{items}{pager}',
            'tableOptions' => ['class' => 'table header-border table-hover verticle-middle'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'id_ins_products',
                'id_directory_appform',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>






