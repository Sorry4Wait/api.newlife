<?php

use app\modules\admin\models\AuthItem;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */

$this->title = Yii::t('messages', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messages', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-body">
        <div class="card-header row">
            <div class="col col-sm-8">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
        </div>
        <hr>
        <div class="auth-item-create">
            <div class="auth-item-form">

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'name')->textInput() ?>
                <?= $form->field($model, 'new_permissions')->widget(MultipleInput::className(), [
                    'max' => 10,
                    'min' => 0,
                    'iconMap' => [
                        'glyphicons' => [
                            'drag-handle' => 'icon-menu',
                            'remove' => 'fa fa-times',
                            'add' => 'fa fa-plus',
                            'clone' => 'icon-plus',
                        ],
                    ],
                    'columns' => [
                        [
                            'name' => 'name',
                            'title' => 'Nomi',
                            'defaultValue' => "",
                        ],
                        [
                            'name' => 'description_uz',
                            'title' => 'Desc Uz',
                        ],
                        [
                            'name' => 'description_ru',
                            'title' => 'Desc Ru',
                        ],
                    ]
                ])->label('Permissions');
                ?>

                <?=
                $form->field($model, 'category')->widget(Select2::classname(), [
                    'data' => $model->getCategory($model->name),
                    'options' => ['placeholder' => Yii::t('messages', 'Select_Category'), 'value' => $model->category],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <div class="form-group float-right">

                    <?=
                    Html::a(Yii::t('messages', 'Back'), ['index'], ['class' => 'btn  mr-2 mb-1 btn-danger btn-rounded'])
                    ?>
                    <?= Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn  mb-1 gradient-1 btn-rounded']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>

