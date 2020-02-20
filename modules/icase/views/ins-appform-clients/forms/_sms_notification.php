<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%">
                <b>СМС ИНФОРМИРОВАНИЯ</b>
            </td>
            <td>
                <?=
                $appform->field($model, 'sms_notification')
                    ->radioList(
                        [0 => 'Возражаю', 1 => 'Не возражаю против информирования по вышеуказанному номеру телефона с применением SMS
                или путем рассылки на e-mail'],
                        [
                            'item' => function($index, $label, $name, $checked, $value) {

                                $return = '<label class="modal-radio mt-2">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                $return .= '<i></i>';
                                $return .= '<span>&nbsp;' . ucwords($label) . '</span>';
                                $return .= '</label><br/>';

                                return $return;
                            }
                        ]
                    )
                    ->label(false);
                ?>
            </td>


        </tr>
        </tbody>
    </table>
</div>