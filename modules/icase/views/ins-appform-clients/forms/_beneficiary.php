<div class="table-responsive">
    <table class="table table-bordered">
        <caption class="text-center"><b>ВЫГОДОПРИОБРАТАТЕЛЬ НА СЛУЧАЙ СМЕРТИ ЗАСТРАХОВАННОГО ЛИЦА</b>
        </caption>
        <tbody>
        <tr>
            <td style="width: 15%">Ф.И.О</td>
            <td style="width: 85%">

                <div class="input-group">
                    <input class="form-control" id="id_beneficiary" type="text" disabled="disabled">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary check_citizen btn-sm" data-model-type="id_beneficiary"
                                type="button" id="check_citizen">Select
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <?php echo $appform->field($model, 'id_beneficiary')->hiddenInput()->label(false); ?>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%">Паспортные данные:</td>
            <td style="width: 85%"><span id="passport_info_beneficiary"></span></td>
        </tr>
        </tbody>
    </table>
</div>
