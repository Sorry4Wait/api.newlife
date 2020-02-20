<?php

namespace app\modules\v1;

/**
 * v1 module definition class
 */
class v1 extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\v1\controllers';
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
}
