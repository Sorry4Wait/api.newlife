<?php

use app\assets\AppAsset;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\web\View;
//use yii\bootstrap4\ActiveForm;
use kartik\form\ActiveForm;

$saveAppFormUrl = \Yii::$app->urlManager->createUrl("/icase/ins-appform-clients/save");
?>
<div class="modal fade" id="modalWindowAppFormClient" role="dialog"
     aria-labelledby="myModalLabel"
     data-backdrop="static"
     aria-hidden="true" style="display: none; padding-left: 0px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Client information </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-4">
                <h3><?php echo Yii::t('messages', 'Application Form'); ?></h3>
            </div>
        </div>
        <hr>
        <div role="content">
            <div class="widget-body padding">
                <?php $appform_clients = ActiveForm::begin([
                    'id' => 'ins-appform-clients-form',
                    'action' => ['ins-appform-clients/save'],
                ]); ?>
                <?php echo $appform_clients->field($model, 'id_products')->hiddenInput(['value' => $product->id])->label(false); ?>
                <div class="alert alert-info  text-center"><b>АНКЕТА-ЗАЯВЛЕНИЕ</b><br>
                    <?php
                    echo $classification;
                    ?></div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width: 15%"><b>Программа страхования:</b></td>
                            <td style="width: 85%"><h4><span
                                            class="label label-secondary"><?php echo $product->name_ru; ?> </span>
                                </h4></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php echo $appform_clients->field($model, 'array_ids')->hiddenInput()->label(false); ?>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="table-responsive">
                            <?php
                            echo $this->render('forms/_insured', ['appform' => $appform_clients, 'model' => $model]);
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="table-responsive">
                            <?php
                            echo $this->render('forms/_insurer', ['appform' => $appform_clients, 'model' => $model]);
                            ?>
                        </div>
                        <div class="table-responsive">
                            <?php
                            foreach ($appform as $form) {
                                switch ($form->id_directory_appform) {
                                    case '3':
                                        echo $this->render('forms/_beneficiary', ['appform' => $appform_clients, 'model' => $model]);
                                        break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                echo $this->render('forms/_sms_notification', ['appform' => $appform_clients, 'model' => $model]);
                foreach ($appform as $form) {
                    switch ($form->id_directory_appform) {
                        case '4':
                            echo $this->render('forms/_insurance_period', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                    }
                }
                foreach ($appform as $form) {
                    switch ($form->id_directory_appform) {
                        case '16':
                            echo $this->render('forms/_commencement_date', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                    }
                }
                foreach ($appform as $form) {
                    switch ($form->id_directory_appform) {
                        case '11':
                            echo $this->render('forms/_ins_premium', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                        case '12':
                            echo $this->render('forms/_ins_amount', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                        case '13':
                            echo $this->render('forms/_ins_amount_survival', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                        case '14':
                            echo $this->render('forms/_ins_sum_death', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                        case '15':
                            echo $this->render('forms/_ins_annual_premium', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                    }
                }

                echo $this->render('forms/_insurance_fee', ['appform' => $appform_clients, 'model' => $model]);

                foreach ($appform as $form) {
                    switch ($form->id_directory_appform) {

                        case '7':
                            echo $this->render('forms/_payment_method', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                        case '8':
                            echo $this->render('forms/_acquaintance_rule');
                            break;
                        case '9':
                            echo $this->render('forms/_date_formation', ['appform' => $appform_clients, 'model' => $model]);
                            break;
                    }
                }
                ?>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>

        </div>

    </div>
</div>


<?php
$url_create_new = \Yii::$app->urlManager->createUrl("/icase/ins-insured-clients/create");
$url_search = \Yii::$app->urlManager->createUrl("/icase/ins-insured-clients/client-search");
$url_check = \Yii::$app->urlManager->createUrl("/icase/ins-insured-clients/check");
$this->registerJsVar('url_check', $url_check);
$this->registerJsVar('url_create_new', $url_create_new);
$this->registerJsVar('url_search', $url_search);
$this->registerJsFile(
    Yii::$app->request->baseUrl . '/js/ins-appform-clients/registration.js',
    [
        'depends' => [AppAsset::className()]
    ]
);
?>
