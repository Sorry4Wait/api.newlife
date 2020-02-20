<?php
namespace app\modules\icase\models;
use Yii;
use yii\base\Model;

class InsInsuredClientsSearchModel extends Model
{
    public $document;
    public $pinpp;

    public function rules()
    {
        return [
            [['document','pinpp'], 'required'],
            [['document'], 'string', 'min' => 9,'max' => 9],
            [['pinpp'], 'string', 'min' => 14,'max' => 19],
        ];
    }

    public function attributeLabels()
    {
        return [
            'document' => Yii::t('messages', 'Document'),
            'pinpp' => Yii::t('messages', 'Pinpp'),
        ];
    }
}