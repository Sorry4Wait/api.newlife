<?php

use yii\helpers\Html;

$themeUrl = Yii::getAlias('@web/themes/pc');
$createUrl = \Yii::$app->urlManager->createUrl("/icase/ins-products/registration");
?>
<div class="row">
    <?php
    $random_number = 1;

    ?>
    <?php foreach ($model as $m): ?>
        <div class="col-lg-3 col-sm-6 mb-5">
            <div class="card gradient-<?= $random_number ?>">
                <div class="card-body text-center">
                    <h3 class="card-title text-center"><?php echo $m->name_ru; ?></h3>
                    <div class="d-inline-block">
                        <h4>
                            <?php echo $m->un_code; ?><span class="subscript">/mo</span></h4>
                        <small><?php
                            if ($m->date_approve) {
                                echo date('d-m-Y H:i:s', strtotime($m->date_approve));
                            }else{
                                echo "Не одобрено";
                            }
                            ?></small>
                        <br>
                        <?php echo $m->productPrefix->prefix; ?>
                        <br>
                        <?php echo $m->productKind->name_ru; ?>
                        <br>
                        <br>
                        <?=

                        Html::a('Создать',
                            ['ins-appform-clients/registration'],
                            [
                                'class' => 'btn btn-lg border-0 btn-rounded px-5  btn-outline-secondary',
                                'data' => [
                                    'method' => 'post',
                                    'params' => ['id' => $m->id], // <- extra level
                                ],
                            ]
                        );

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $random_number++;
        if ($random_number === 10) {
            $random_number = 1;
        }
        ?>
    <?php endforeach; ?>

</div>

