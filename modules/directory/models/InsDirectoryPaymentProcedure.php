<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_payment_procedure".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property InsAppformClients[] $insAppformClients
 */
class InsDirectoryPaymentProcedure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_payment_procedure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsAppformClients()
    {
        return $this->hasMany(InsAppformClients::className(), ['id_payment_procedure' => 'id']);
    }
}
