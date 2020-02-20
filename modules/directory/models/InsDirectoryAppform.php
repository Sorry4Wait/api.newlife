<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_appform".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property InsProductsAppform[] $insProductsAppforms
 * @property InsProducts[] $insProducts
 */
class InsDirectoryAppform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_appform';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'required'],
            [['name_uz', 'name_ru'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => Yii::t('messages','Name Uz'),
            'name_ru' => Yii::t('messages','Name Ru'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProductsAppforms()
    {
        return $this->hasMany(InsProductsAppform::className(), ['id_directory_appform' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProducts()
    {
        return $this->hasMany(InsProducts::className(), ['id' => 'id_ins_products'])->viaTable('ins_products_appform', ['id_directory_appform' => 'id']);
    }
}
