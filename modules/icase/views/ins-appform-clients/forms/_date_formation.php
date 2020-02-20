<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%"><b>ДАТА ЗАПОЛНЕНИЯ:</b></td>
            <td style="width: 85%">
                <?php

                use kartik\date\DatePicker;

                echo $appform->field($model, 'date_formation')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter date_formation ...', 'class' => ''],
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

