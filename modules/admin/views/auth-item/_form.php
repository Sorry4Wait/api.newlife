<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

// "[{$i}]date_of_leave"
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">

    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-8">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
        </div>
        <hr>
        <div class="auth-item-form">

            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => false, 'class' => 'customAjaxForm', 'customAjaxForm-model' => 'ins-insured-clients'],
            ]); ?>


            <div class="row form-group">

                <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-6">
                    <?php if ($model->type == 2): ?>
                        <?=
                        $form->field($model, 'category')->widget(Select2::classname(), [
                            'data' => $model->getCategory($model->name),
                            'size' => Select2::SIZE_SMALL,
                            'options' => ['placeholder' => Yii::t('messages','Select_Category'),'value' => $model->category],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    <?php endif;?>
                </div>

            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <?= $form->field($model, 'description_uz')->textarea(['rows' => 3]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'description_ru')->textarea(['rows' => 3]) ?>
                </div>
            </div>



            <div class="form-group float-right">

                <?=
                 Html::a(Yii::t('messages', 'Back'), $model->type !== 2 ? ['index'] : ['permissions'], ['class' => 'btn  mr-2 mb-1 btn-danger btn-rounded'])
                ?>
                <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn  mb-1 gradient-1 btn-rounded']) ?>

            </div>
            <br>
            <br>
            <br>
            <?php if ($model->type == '1'): ?>

                <div class="col-md-12" id="permissions-content">
                    <?php foreach ($perms as $key => $allperm):?>

                        <fieldset class="col-md-12" style="margin-bottom: 10px">
                            <legend><?= $key?></legend>
                            <hr>
                                    <div class="row">
                                        <?php foreach ($allperm as $key => $perm): ?>
                                            <div class="col-md-4">
                                                <?= $form->field($model, "perms[{$key}]")->checkbox(['checked' => $model->checkPermitionChecked($key), 'label' => $perm]) ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>


                        </fieldset>


                    <?php endforeach;?>
                </div>

            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

