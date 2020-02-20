<?php
/* @var $this yii\web\View */
/* @var $client app\modules\icase\models\InsInsuredClientsSearchModel */

/* @var $form yii\widgets\ActiveForm */


use yii\bootstrap4\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
?>


<?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['ins-insured-clients/check']),
        'method' => 'POST',
        'options' => ['class' => 'check-insured-client'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-4',
            ],
        ],
    ]
); ?>
    <div class="row form-group">
        <div class="col-md-6">
            <?= $form->field($client, 'document')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($client, 'pinpp')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
        </div>
    </div>


    <div class="form-group">

        <?= Html::submitButton(Yii::t('messages', 'Search'), ['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right']) ?>
        <button type="button" class="btn   mr-2 mb-1 btn-sm btn-danger btn-rounded float-right" data-dismiss="modal">
            <?php echo Yii::t('messages', 'Cancel'); ?>
        </button>
    </div>

<?php ActiveForm::end(); ?>

