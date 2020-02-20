<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_product_status".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property InsProducts[] $insProducts
 */
class InsDirectoryProductStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_product_status';
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
            'name_uz' => Yii::t('messages', 'Name Uz'),
            'name_ru' => Yii::t('messages', 'Name Ru'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProducts()
    {
        return $this->hasMany(InsProducts::className(), ['id_product_status' => 'id']);
    }
}
