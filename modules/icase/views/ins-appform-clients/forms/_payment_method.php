<?php

use yii\helpers\ArrayHelper;
use app\modules\directory\models\InsDirectoryPaymentProcedure;

?>
<div class="table-responsive smart-form">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td style="width: 15%"><b>ПОРЯДОК ОПЛАТЫ ВЗНОСА</b></td>
            <td style="width: 85%">
                <!--                <div class="inline-group">-->
                <!--                    <label class="radio">-->
                <!--                        <input type="radio" name="radio-inline" checked="checked">-->
                <!--                        <i></i>Ежемесячно</label>-->
                <!--                    <label class="radio">-->
                <!--                        <input type="radio" name="radio-inline">-->
                <!--                        <i></i>Ежеквартально</label>-->
                <!--                    <label class="radio">-->
                <!--                        <input type="radio" name="radio-inline">-->
                <!--                        <i></i>Раз в полгода</label>-->
                <!--                    <label class="radio">-->
                <!--                        <input type="radio" name="radio-inline">-->
                <!--                        <i></i>Ежегодно</label>-->
                <!--                    <label class="radio">-->
                <!--                        <input type="radio" name="radio-inline">-->
                <!--                        <i></i>Единовременно</label>-->
                <!--                </div>-->
                <div class="inline-group">
                    <?= $appform->field($model, 'id_payment_procedure')
                        ->radioList(ArrayHelper::map(InsDirectoryPaymentProcedure::find()->all(), 'id', 'name_ru'), array('class' => ' inline-group'))->label(false) ?>

                </div>

            </td>
        </tr>
        </tbody>
    </table>
</div>