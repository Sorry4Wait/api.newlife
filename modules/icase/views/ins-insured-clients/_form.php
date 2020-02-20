<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\icase\models\InsInsuredClients */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$fildOption = [
    'options' => ['class' => 'form-group row text-center'],
    'template' => "<label class=\"col-lg-4 col-form-label\" for=\"val-username\">{label} <span class=\"text-danger\">*</span>
                    </label><div class=\"col-lg-6\">{input}\n{error}</div>",
];
?>
<div class="alert alert-info alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Клиент не найден!</strong> Но вы можете его добавить заполнив эту форму.
</div>

<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => false, 'class' => 'customAjaxForm', 'customAjaxForm-model' => 'ins-insured-clients'],
]); ?>

<div class="row form-group">
    <div class="col-md-4">
        <?= $form->field($model, 'document')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'pinpp')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'name_latin')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-4">
        <?= $form->field($model, 'surname_latin')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'patronym_latin')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'name_engl')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
</div>
<div class="row form-group">
    <div class="col-md-4">
        <?= $form->field($model, 'surname_engl')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter date_formation ...', 'class'=>'input-sm'],
            'pluginOptions' => [
                'autoclose' => true,
            ]
        ]);
        ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'birth_place_id')->widget(Select2::classname(), [
            'data' => [11, 22, 334],
            'language' => 'ru',
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="row form-group">

    <div class="col-md-4">
        <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>

    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'birth_country')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'birth_country_id')->widget(Select2::classname(), [
            'data' => [1, 2, 3],
            'language' => 'ru',
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>


<div class="row form-group">
    <div class="col-md-4">
        <?= $form->field($model, 'livestatus')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'nationality')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'nationality_id')->widget(Select2::classname(), [
            'data' => [23, 253, 43],
            'language' => 'ru',
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="row form-group">

    <div class="col-md-4">
        <?= $form->field($model, 'citizenship')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'citizenship_id')->widget(Select2::classname(), [
            'data' => ['test', 'test2', 'test3'],
            'language' => 'ru',
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'sex')->widget(Select2::classname(), [
            'data' => ['Man', 'Woman'],
            'language' => 'ru',
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="row form-group">
    <div class="col-md-4">
        <?= $form->field($model, 'doc_give_place')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'doc_give_place_id')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'date_begin_document')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter date_formation ...', 'class'=>'input-sm'],
            'pluginOptions' => [
                'autoclose' => true,
            ]
        ]);
        ?>
    </div>
</div>
<div class="row form-group">

    <div class="col-md-4">
        <?= $form->field($model, 'date_end_document')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter date_formation ...', 'class'=>'input-sm'],
            'pluginOptions' => [
                'autoclose' => true,
            ]
        ]);
        ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'inn')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'who_registred')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>

    </div>
</div>

<div class="row form-group">
    <div class="col-md-4">
        <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>

    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
</div>
<div class="row form-group">

    <div class="col-md-4">
        <?= $form->field($model, 'citizen_status')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'work_place')->textInput(['maxlength' => true, 'class' => ['form-control input-rounded']]) ?>
    </div>
</div>



<div class="form-group">

    <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-sm mb-1 gradient-1 btn-rounded float-right']) ?>
    <button type="button" class="btn   mr-2 mb-1 btn-danger btn-rounded float-right btn-sm" data-dismiss="modal">
        <?php echo Yii::t('messages', 'Cancel'); ?>
    </button>
</div>


<?php ActiveForm::end(); ?>

