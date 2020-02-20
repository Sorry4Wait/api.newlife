<?php


namespace app\components;


use yii\rest\Serializer;

class MySerializer extends Serializer
{
    public function serialize($data)
    {

        $d = parent::serialize($data);
//        echo "<pre>";
//        print_r($d);
//        echo "</pre>";
//        exit();
        $m = $d['_links'];
        unset($d['_links']);
        unset($d['self']);
        return $d;
    }
}