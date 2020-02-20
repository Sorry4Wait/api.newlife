<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%"><b>СТРАХОВАЯ СУММА ПРИ СМЕРТИ:</b></td>
            <td style="width: 85%">
                <?php

                use kartik\number\NumberControl;

                echo $appform->field($model, 'ins_sum_death')->widget(NumberControl::classname(), [
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

