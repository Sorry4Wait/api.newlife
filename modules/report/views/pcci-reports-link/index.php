<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use http\Header;
use http\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\report\models\PcciReportsLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Pcci Reports Links';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcci-reports-link-index">

    <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
    <p>
        <?= Html::a('Create Pcci Reports Link', ['javascript:void(0);'], ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modalCreateDocs']) ?>
    </p>
    <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalChangePassword">-->
    </a>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items} {pager}',
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'id',
                'visible' => false
            ],
            'link',
            'create_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}  {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-2x fa-download"></span>', $url, [
                            'title' => 'Download',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-2x fa-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => 'Are you sure you want to delete?',
                            'data-method' => 'post',
                            'data-pjax' => '1',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div class="modal fade" id="modalCreateDocs" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
            </div>
            <div class="modal-body">
                <?=
                $this->render('_form', ['model' => $model]);
                ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>