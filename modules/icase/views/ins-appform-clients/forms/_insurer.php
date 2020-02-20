<table class="table table-bordered">
    <caption class="text-center"><b>ЗАСТРАХОВАННОЕ ЛИЦО</b></caption>
    <tbody>
    <tr>
        <td style="width: 15%">Ф.И.О</td>
        <td style="width: 85%">

            <div class="input-group">
                <input class="form-control" id="fio_insurer" type="text" disabled="disabled">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary check_citizen btn-sm" data-model-type="id_insurer_clients" type="button" id="check_citizen">Select</button>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <?php echo $appform->field($model, 'id_insurer_clients')->hiddenInput()->label(false); ?>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="width: 15%">Паспортные данные:</td>
        <td style="width: 85%"><span id="passport_info_insurer"></span></td>
    </tr>
    <tr>
        <td style="width: 15%">Дата рождения:</td>
        <td style="width: 85%">&nbsp; <span id="birth_info_insurer"></span></td>
    </tr>
    <tr>
        <td style="width: 15%">Адрес:</td>
        <td style="width: 85%">&nbsp;
            <?php echo $appform->field($model, 'address2')->textInput(['class' => 'form-control'])->label(false); ?>
        </td>
    </tr>
    </tbody>
</table>

