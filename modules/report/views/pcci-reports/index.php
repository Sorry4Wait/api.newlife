<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\report\models\PcciReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
$reportUrl = \Yii::$app->urlManager->createUrl("/report/pcci-reports-link");
?>

<?php if (\Yii::$app->session->hasFlash('uploadMsg')) { ?>
    <div class="alert alert-success">
        <?php \Yii::$app->session->getFlash('uploadMsg'); ?>
    </div>
<?php } ?>

<div class="pcci-reports-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">

        <div class="col-xs-6 col-md-6">
            <p>
                <?= Html::a('Create Pcci Reports', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{items} {pager}',
//                'filterModel' => $searchModel,
                'tableOptions' => [
                    'id' => 'myGrid',
                    'class' => ' table table-hover table-striped table-bordered',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'id',
                        'visible' => false
                    ],
                    [
                        'label' => 'department_id',
                        'visible' => false
                    ],
                    'report_name',

//                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <div class="col-xs-6 col-md-6">
            <div class="secondtable">

            </div>
        </div>
    </div>


    <?php Pjax::end(); ?>
</div>
<?php

$this->registerJS(
    '
            $(document).ready(function () {
            $("tr").on("click", function (ev) {
                var id = $("td:first", $(this)).text();
                $.ajax({
                    type: "GET",
                    url:"' . $reportUrl . '",
                    data: "report_id="+id,
                    success: function (msg) {
                    if ((msg.length>0)){
                        $(".secondtable").html(msg);
                        $("#pccireportslink-reports_id").val(id);
                    }
                    }}
                );
            })
        });
        
        '
    , View::POS_END
);

$this->registerJs(
    '
            $(".grid-view tbody tr").on("click", function() {
              $(".grid-view tbody tr").removeClass("selected");
              $(this).addClass("selected");
            });
            '
)
?>

