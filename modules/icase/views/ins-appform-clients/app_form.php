<?php

use yii\helpers\Html;
use yii\web\View;


$this->title = 'Ins Products';
$this->params['breadcrumbs'][] = $this->title;
$themeUrl = Yii::getAlias('@web/themes/pc');

?>
    <div class="ins-products-index">
        <fieldset>
            <div class="form-group text-center">
                <div class="col-lg-12">
                    <div class="btn-group-lg" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="product_type" value="1">
                            Физическое лицо</label>
                        <label class="btn btn-default">
                            <input type="radio" name="product_type" value="2">
                            Юридическое лицо </label>
                    </div>
                </div>
        </fieldset>
        <br>
        <fieldset>
            <div id="result">

            </div>
        </fieldset>
    </div>

<?php
$physicalProductsUrl = \Yii::$app->urlManager->createUrl("/icase/ins-appform-clients/physical");
$legalProductsUrl = \Yii::$app->urlManager->createUrl("/icase/ins-appform-clients/legal");
$this->registerJS(
    "
            $(document).ready(function () {
               $('input[name=product_type]').change(function(){
                    var value = $( 'input[name=product_type]:checked' ).val();
                        switch(value){
                            case '1':
                                    $('#result').load('$physicalProductsUrl', {key: 1});
                                break;
                            case '2':
                                $('#result').load('$legalProductsUrl', {key: 2});
                                break;
                        }
               });
               
                $('#loadingDiv').hide().ajaxStart( function() {
                        $(this).show();  // show Loading Div
                        } ).ajaxStop ( function(){
                        $(this).hide(); // hide loading div
                   });
               
                
            });
        
        "
    , View::POS_END
);

?>