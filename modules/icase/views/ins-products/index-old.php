<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ins Products';
$this->params['breadcrumbs'][] = $this->title;
$classificationUrl = \Yii::$app->urlManager->createUrl("/icase/ins-products-classification/index");

?>
<div class="ins-products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product', '#', ['class' => 'btn btn-success', 'id' => 'productButton']) ?>
    </p>
    <?php Pjax::begin(['id' => 'products-grid-view']); ?>

    <?php echo $this->renderAjax('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => [
            'id' => 'w0',
            'class' => ' table table-hover table-striped table-bordered',
        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name_uz',
            'name_ru',
            [
                'attribute' => 'id_product_type',
                'value' => function ($model, $key, $index, $column) {
                    $data = $model->productType->name_ru;
                    if (empty($data)) {
                        return null;
                    } else {
                        return $data;
                    }
                },
            ],
            [
                'attribute' => 'id_product_kind',
                'value' => function ($model, $key, $index, $column) {
                    $data = $model->productKind->name_ru;
                    if (empty($data)) {
                        return null;
                    } else {
                        return $data;
                    }
                },
            ],
            'id_product_prefix',
            [
                'attribute' => 'id_product_status',
                'value' => function ($model, $key, $index, $column) {
                    $data = $model->productStatus->name_ru;
                    if (empty($data)) {
                        return null;
                    } else {
                        return $data;
                    }
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Delete', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => 'Are you sure you want to delete?',
                            'data-method' => 'post',
                            'data-pjax' => '1',
                            'class' => 'btn btn-danger'
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Edit', $url, [
                            'title' => Yii::t('yii', 'Edit'),
                            'data-pjax' => '1',
                            'class' => 'btn btn-info'
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div class="secondtable">

</div>
<?php

$this->registerJs(
    '
            $("#productButton").on("click",function(e){
               e.preventDefault();
               $("#modalProduct").modal();
            });
            
        
    ', View::POS_READY
);
$this->registerJs(
    '
            $(".grid-view tbody tr").on("click", function() {
              $(".grid-view tbody tr").removeClass("selected");
              $(this).addClass("selected");
            });
            ', View::POS_READY
);

$this->registerJS(
    '
            $(document).ready(function () {
            $("tr").on("click", function (ev) {
                var id = $("td:nth-child(2)", $(this)).text();
                $.ajax({
                    type: "GET",
                    url:"' . $classificationUrl . '",
                    data: "root="+id,
                    success: function (msg) {
                    if ((msg.length>0)){
                        $(".secondtable").html(msg);
                        $("#insproductsclassification-id_products").val(id);
                        $("#insproductscalculation-id_products").val(id);
                        
                    }
                    }}
                );
            })
        });
        
        '
    , View::POS_END
);

?>


<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">

    <?=
    $this->render('_form', ['model' => $model]);
    ?>

</div>
