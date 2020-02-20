<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%"><b>СТРАХОВАЯ СУММА:</b></td>
            <td style="width: 85%">
                <!--                --><?php //echo $appform->field($model, 'ins_amount')->textInput(['class' => 'form-control'])->label(false); ?>
                <?php

                use kartik\number\NumberControl;

                echo $appform->field($model, 'ins_amount')->widget(NumberControl::classname(), [
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