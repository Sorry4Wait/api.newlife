<?php

use kartik\date\DatePicker;

?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 25%"><b>ПЕРИОД СТРАХОВАНИЯ:</b></td>
            <td style="width: 25%">&nbsp;
                <?php
                echo $appform->field($model, 'ins_period_bdate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter begin date ...', 'class'=>'input-sm'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ])->label(false);
                ?>
                <?php
                echo $appform->field($model, 'ins_period_edate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter end date ...', 'class'=>'input-sm'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ])->label(false);
                ?>
            </td>
            <td style="width: 15%"><b>ДАТА ПЕРВОГО ВЗНОСА:</b></td>
            <td style="width: 35%">&nbsp;
                <?php
                echo $appform->field($model, 'first_downpayment_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter payment date ...', 'class' => ''],
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
