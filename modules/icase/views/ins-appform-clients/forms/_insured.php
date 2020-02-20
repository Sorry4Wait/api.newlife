<table class="table table-bordered">
    <caption class="text-center"><b>СТРАХОВАТЕЛЬ</b></caption>
    <tbody>
    <tr>
        <td style="width: 15%">Ф.И.О</td>
        <td style="width: 85%">
            <div class="input-group">
                <input class="form-control" id="fio_insured" type="text" disabled="disabled">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary check_citizen btn-sm" data-model-type="id_insured_clients" type="button" id="check_citizen">Select</button>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <?php echo $appform->field($model, 'id_insured_clients')->hiddenInput()->label(false); ?>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">Паспортные данные:</td>
        <td style="width: 85%">
            <span id="passport_info"></span>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">Дата рождения:</td>
        <td style="width: 85%">
            <span id="birth_info"></span></td>
    </tr>
    <tr>
        <td style="width: 15%">Адрес:</td>
        <td style="width: 85%">
            <?php echo $appform->field($model, 'address')->textInput(['class' => 'form-control'])->label(false); ?>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">Место работы:</td>
        <td style="width: 85%">&nbsp;
            <?php echo $appform->field($model, 'work_place')->textInput(['class' => 'form-control'])->label(false); ?>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">ИНН:</td>
        <td style="width: 85%">&nbsp;
            <?php echo $appform->field($model, 'inn')->textInput(['class' => 'form-control','readonly' => true])->label(false); ?>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">Телефон:</td>
        <td style="width: 85%">&nbsp;
            <?php echo $appform->field($model, 'phone')->textInput(['class' => 'form-control'])->label(false); ?>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">e-mail:</td>
        <td style="width: 85%">
            <?php echo $appform->field($model, 'email')->textInput(['class' => 'form-control'])->label(false); ?>
        </td>
    </tr>
    </tbody>
</table>


