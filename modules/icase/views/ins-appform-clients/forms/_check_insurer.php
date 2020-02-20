<?php

use app\modules\icase\models\InsInsuredClients;
use demogorgorn\ajax\AjaxSubmitButton;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsInsuredClients */
/* @var $form yii\widgets\ActiveForm */

$checkUrl = \Yii::$app->urlManager->createUrl("/icase/ins-insured-clients/check");
$items = [
    'AA' => 'AA',
    'AB' => 'AB',
    'KA' => 'KA',
];

use yii\web\View;
use yii\widgets\ActiveForm; ?>
<?php $form = ActiveForm::begin([
        'id' => 'ins-insurer-clients-form',
        'action' => '',
        'options' => [
            'class' => 'smart-form bv-form',
            'data-pjax' => 1
        ]]
); ?>

    <fieldset>
        <div class="row">
            <section class="col col-3">
                <label class="label">Passport Serial</label>
                <label class="input">
                    <?= $form->field($client, 'pass_serial')->dropDownList($items)->label(false); ?>
                </label>
            </section>
            <section class="col col-9">
                <label class="label">Passport Number</label>
                <label class="input">
                    <i class="icon-append fa fa-envelope-o"></i>
                    <?= $form->field($client, 'pass_number')->textInput(['maxlength' => true])->label(false) ?>
                </label>
            </section>
        </div>

        <section>
            <label class="label">Subject</label>
            <label class="input">
                <i class="icon-append fa fa-tag"></i>
                <?= $form->field($client, 'pinpp')->textInput(['maxlength' => true])->label(false) ?>
            </label>
        </section>

    </fieldset>
    <footer>
        <?php AjaxSubmitButton::begin([
            'label' => 'Save',
            'useWithActiveForm' => 'ins-insurer-clients-form',
            'ajaxOptions' => [
                'dataType' => 'json',
                'type' => 'POST',
                'url' => $checkUrl,
                'success' => new \yii\web\JsExpression('function(html){
                        if(html.status == "success"){
                             $("#fio_insurer").val(html.fio);
                             $("#insappformclients-id_insurer_clients").val(html.id);
                             $("#passport_info_insurer").text(html.passport_info);
                             $("#birth_info_insurer").text(html.birth_info);
                             $("#modalInsurer").modal("hide");
                             $("#ins-insurer-clients-form").each(function(){
                                    this.reset();
                             });
                        }
                        else(html.status == "error")
                        {
//                           alert(html.detail);
                           $("#modalInsurer").modal("hide");
                             $("#ins-insurer-clients-form").each(function(){
                                    this.reset();
                             }); 
                        }
                }'),
            ],
            'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
        ]);
        AjaxSubmitButton::end();
        ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancel
        </button>
    </footer>

<?php ActiveForm::end(); ?>