<?php

use kartik\date\DatePicker;
use yii\web\View;
use kartik\number\NumberControl;

?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%"><b>ДАТА НАЧАЛА РЕНТНЫХ ПЛАТЕЖЕЙ:</b></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="monthly"
                               onclick="changeAttrField('monthly');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По ежемесячной ренте до достижения 60 лет
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php

                    echo $appform->field($model, 'monthly_com_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'monthly_com_date...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'monthly_com_payment')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'monthly_com_payment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="quarterly"
                               onclick="changeAttrField('quarterly');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По ежеквартальной ренте до достижения 60 лет:
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'quarterly_com_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'quarterly_com_date ...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'quarterly_com_payment')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'quarterly_com_payment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="semiannual"
                               onclick="changeAttrField('semiannual');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По полугодовой ренте до достижения 60 лет:
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'semiannual_com_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'semiannual_com_date ...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'semiannual_com_payment')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'semiannual_com_payment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="annual"
                               onclick="changeAttrField('annual');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По ежегодной ренте до достижения 60 лет:
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'annual_com_date ...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_payment')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'annual_com_payment')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="annual_fm"
                               onclick="changeAttrField('annual','fm');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По ежегодной ренте до достижения 60 лет (1 месяц):
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_date_fm')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'annual_com_date_fm ...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_payment_fm')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'annual_com_payment_fm')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="annual_em"
                               onclick="changeAttrField('annual','em');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По ежегодной ренте до достижения 60 лет (12 месяц):
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_date_em')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'annual_com_date_em ...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_payment_em')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'annual_com_payment_em')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <div class="">
                    <label class="toggle" style="display: inline-block">
                        <input type="checkbox" id="annual_as"
                               onclick="changeAttrField('annual','as');">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                        По ежегодной ренте после достижения 60 лет:
                    </label>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_date_as')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'annual_com_date_as ...', 'class' => '', 'disabled' => 'disabled'],
                        'pluginOptions' => [
                            'autoclose' => true,
                        ]
                    ])->label(false);
                    ?>
                </div>
            </td>
            <td style="width: 25%">
                <div class="">
                    <?php
                    echo $appform->field($model, 'annual_com_payment_as')->widget(NumberControl::classname(), [
                        'displayOptions' => ['disabled' => 'disabled'],
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' сум',
                            'allowMinus' => false,
                        ],
                    ])->label(false);
                    ?>
                    <!--                    --><?php //echo $appform->field($model, 'annual_com_payment_as')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
