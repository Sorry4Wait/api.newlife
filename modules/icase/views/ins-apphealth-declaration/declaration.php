<?php

use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$saveAppFormUrl = \Yii::$app->urlManager->createUrl("/icase/ins-apphealth-declaration/save");

/* @var $this yii\web\View */
/* @var $searchModel app\modules\icase\models\InsApphealthDeclarationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<div class="card">
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h3><?php echo Yii::t('messages', 'Declaration Form'); ?></h3>
            </div>

            <div class="col col-sm-8 float-md-right">
                <!--                --><?//= Html::a(Yii::t('messages','Edit').'<span class="btn-icon-right"><i class="fa fa-edit"></i></span>',['create'],['class' => 'btn  mb-1 gradient-1 btn-rounded float-right','id' => 'productButton'])?>
            </div>
        </div>
        <hr>
        <div class="" id="wid-id-0" data-widget-colorbutton="false"
             data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
            <div role="content">
                <div class="widget-body padding">
                    <?php $apphealth = ActiveForm::begin([
                        'id' => 'ins-apphealth-declaration-form',
                        'action' => '',
                        'options' => [
                            'class' => 'bv-form',
                            'data-pjax' => 1
                        ]
                    ]); ?>
                    <?php echo $apphealth->field($model, 'id_appform')->hiddenInput(['value' => $form_id])->label(false); ?>
                    <div class="alert alert-info text-center">
                        <h2>ДЕКЛАРАЦИЯ О СОСТОЯНИИ ЗДОРОВЬЯ ЗАСТРАХОВАННОГО ЛИЦА</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 35%"><b>ФИО:</b></td>
                                <td style="width: 30%">
                                <span
                                        class="label label-danger"><?= $client->surname_latin . ' ' . $client->name_latin . ' ' . $client->patronym_latin; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b>Имеется ли у Вас какие-либо хронические заболевания:</b></td>
                                <td style="width: 30%">
                                    <div class="inline-group">
                                        <?= $apphealth->field($model, 'chronic_disease')->radioList(['0' => 'Нет', '1' => 'Да',])->label(false) ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b>Если «да», то укажите диагноз, как и где проводилось лечение
                                        данных заболеваний</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'def_chronic_disease')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 35%"><b>Имеете ли Вы или имели в прошлом группу инвалидности?</b></td>
                                <td style="width: 30%">
                                    <div class="inline-group">
                                        <?= $apphealth->field($model, 'disability')->radioList(['0' => 'Нет', '1' => 'Да',])->label(false) ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b>Если «да», то:</b></td>
                                <td style="width: 65%">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - какая группа инвалидности?</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'group_disability')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - причина инвалидности</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'couse_disability')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - если имели в прошлом, то укажите, когда снята</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'old_disability')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 35%"><b>Находитесь ли Вы под наблюдением врача в настоящее время?</b></td>
                                <td style="width: 70%">
                                    <div class="inline-group">
                                        <?= $apphealth->field($model, 'doctor_observations')->radioList(['0' => 'Нет', '1' => 'Да',])->label(false) ?>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 35%"><b>Находились ли Вы на стационарном лечении за последние 5 лет?</b>
                                </td>
                                <td style="width: 70%">
                                    <div class="inline-group">
                                        <?= $apphealth->field($model, 'inpatient_treatment')->radioList(['0' => 'Нет', '1' => 'Да',])->label(false) ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b>Если «да», то:</b></td>
                                <td style="width: 65%"></td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - сколько раз?</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'count_inpatient_treatment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - название стационара</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'placename_treatment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - заключение, диагноз</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'diagnosis_inpatient_treatment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 35%"><b>Проводились ли Вам какие-либо оперативные вмешательства за
                                        последние 5 лет?</b></td>
                                <td style="width: 70%">
                                    <div class="inline-group">
                                        <?= $apphealth->field($model, 'l5_operation')->radioList(['0' => 'Нет', '1' => 'Да',])->label(false) ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b>Если «да», то:</b></td>
                                <td style="width: 65%">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - укажите причину операции</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'cause_l5_operation')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%"><b> - название медицинского учреждения</b></td>
                                <td style="width: 65%">
                                    <?php echo $apphealth->field($model, 'placename_l5_operation')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Дата заполнения:</b></td>
                                <td style="width: 85%">
                                    <?php

                                    use kartik\date\DatePicker;

                                    echo $apphealth->field($model, 'date_completion')->widget(DatePicker::classname(), [
                                        'options' => ['placeholder' => 'Enter date_formation ...', 'class' => ''],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                        ]
                                    ])->label(false);
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default" type="submit">
                                    Cancel
                                </button>
                                <?php AjaxSubmitButton::begin([
                                    'label' => 'Submit',
                                    'useWithActiveForm' => 'ins-apphealth-declaration-form',
                                    'ajaxOptions' => [
                                        'dataType' => 'json',
                                        'type' => 'POST',
                                        'url' => $saveAppFormUrl,
                                        'success' => new \yii\web\JsExpression('function(html){
                                            if(html.status == "success"){
                                                 $("#modalContract").modal("toggle");
                                            }
                                    }'),
                                    ],
                                    'options' => ['class' => 'btn btn-primary', 'type' => 'submit'],
                                ]);
                                AjaxSubmitButton::end();
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalContract" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">Choose operation</h4>
            </div>
            <div class="modal-body">
                <?php echo
                $this->render('_operation');
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJS(
    '
            $(document).ready(function () {
               $("#insapphealthdeclaration-chronic_disease").change(function(){
                    var value = $( "input[name=\'InsApphealthDeclaration[chronic_disease]\']:checked").val();
                        if(value==1){
                            $("#insapphealthdeclaration-def_chronic_disease").removeAttr("disabled");
                        }
                        else{
                            $("#insapphealthdeclaration-def_chronic_disease").val("");
                            $("#insapphealthdeclaration-def_chronic_disease").attr("disabled", true);
                        }
               });
               
               $("#insapphealthdeclaration-disability").change(function(){
                    var value = $( "input[name=\'InsApphealthDeclaration[disability]\']:checked").val();
                        if(value==1){
                            $("#insapphealthdeclaration-group_disability").removeAttr("disabled");
                            $("#insapphealthdeclaration-couse_disability").removeAttr("disabled");
                            $("#insapphealthdeclaration-old_disability").removeAttr("disabled");
                        }
                        else{
                            $("#insapphealthdeclaration-group_disability").val("");
                            $("#insapphealthdeclaration-couse_disability").val("");
                            $("#insapphealthdeclaration-old_disability").val("");
                            $("#insapphealthdeclaration-group_disability").attr("disabled", true);
                            $("#insapphealthdeclaration-couse_disability").attr("disabled", true);
                            $("#insapphealthdeclaration-old_disability").attr("disabled", true);
                        }
               });
               
               $("#insapphealthdeclaration-inpatient_treatment").change(function(){
                    var value = $( "input[name=\'InsApphealthDeclaration[inpatient_treatment]\']:checked").val();
                        if(value==1){
                            $("#insapphealthdeclaration-count_inpatient_treatment").removeAttr("disabled");
                            $("#insapphealthdeclaration-placename_treatment").removeAttr("disabled");
                            $("#insapphealthdeclaration-diagnosis_inpatient_treatment").removeAttr("disabled");
                        }
                        else{
                            $("#insapphealthdeclaration-count_inpatient_treatment").val("");
                            $("#insapphealthdeclaration-placename_treatment").val("");
                            $("#insapphealthdeclaration-diagnosis_inpatient_treatment").val("");
                            $("#insapphealthdeclaration-count_inpatient_treatment").attr("disabled", true);
                            $("#insapphealthdeclaration-placename_treatment").attr("disabled", true);
                            $("#insapphealthdeclaration-diagnosis_inpatient_treatment").attr("disabled", true);
                        }
               });
               
               $("#insapphealthdeclaration-l5_operation").change(function(){
                    var value = $( "input[name=\'InsApphealthDeclaration[l5_operation]\']:checked").val();
                        if(value==1){
                            $("#insapphealthdeclaration-cause_l5_operation").removeAttr("disabled");
                            $("#insapphealthdeclaration-placename_l5_operation").removeAttr("disabled");
                        }
                        else{
                            $("#insapphealthdeclaration-cause_l5_operation").val("");
                            $("#insapphealthdeclaration-placename_l5_operation").val("");
                            $("#insapphealthdeclaration-cause_l5_operation").attr("disabled", true);
                            $("#insapphealthdeclaration-placename_l5_operation").attr("disabled", true);
                        }
               });
               
            });
        
        '
    , View::POS_END
);
?>
