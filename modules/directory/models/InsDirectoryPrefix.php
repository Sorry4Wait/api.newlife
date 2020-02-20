<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_prefix".
 *
 * @property int $id
 * @property string $prefix
 *
 * @property InsProducts[] $insProducts
 */
class InsDirectoryPrefix extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_prefix';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['prefix','unique'],
            [['prefix'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prefix' => Yii::t('messages', 'Prefix'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProducts()
    {
        return $this->hasMany(InsProducts::className(), ['id_product_prefix' => 'id']);
    }
}
