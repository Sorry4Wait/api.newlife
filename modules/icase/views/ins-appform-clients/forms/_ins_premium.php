<?php
use kartik\number\NumberControl;
?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%"><b>СТРАХОВАЯ ПРЕМИЯ:</b></td>
            <td style="width: 85%">
                <?php

//                echo $appform->field($model, 'ins_premium')->textInput(['class' => 'form-control'])->label(false);

                echo $appform->field($model, 'ins_premium')->widget(NumberControl::classname(), [
                    'maskedInputOptions' => [
                        'prefix' => '',
                        'suffix' => ' сум',
                        'allowMinus' => false
                    ],
                ])->label(false);

                ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
