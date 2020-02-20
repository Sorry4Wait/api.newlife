<?php

namespace app\modules\directory\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ins_directory_product_type".
 *
 * @property int $id
 * @property string $namu_uz
 * @property string $name_ru
 *
 * @property InsDirectoryCalculationType[] $insDirectoryCalculationTypes
 * @property InsProducts[] $insProducts
 */
class InsDirectoryProductType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_product_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namu_uz', 'name_ru'], 'required'],
            [['namu_uz', 'name_ru'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namu_uz' => Yii::t('messages', 'Name Uz'),
            'name_ru' => Yii::t('messages', 'Name Ru'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsDirectoryCalculationTypes()
    {
        return $this->hasMany(InsDirectoryCalculationType::className(), ['id_product_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProducts()
    {
        return $this->hasMany(InsProducts::className(), ['id_product_type' => 'id']);
    }

    public static function getProductTypes(){
        $types = InsDirectoryProductType::find()->all();
        return $items = ArrayHelper::map($types, 'id', 'name_ru');
    }
}
