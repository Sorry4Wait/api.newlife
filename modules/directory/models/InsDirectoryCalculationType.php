<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_calculation_type".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $id_product_type
 *
 * @property InsDirectoryProductType $productType
 * @property InsProductsCalculation[] $insProductsCalculations
 */
class InsDirectoryCalculationType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_calculation_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', 'id_product_type'], 'required'],
            [['id_product_type'], 'default', 'value' => null],
            [['id_product_type'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 100],
            [['id_product_type'], 'exist', 'skipOnError' => true, 'targetClass' => InsDirectoryProductType::className(), 'targetAttribute' => ['id_product_type' => 'id']],
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
            'id_product_type' => Yii::t('messages','Product Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(InsDirectoryProductType::className(), ['id' => 'id_product_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProductsCalculations()
    {
        return $this->hasMany(InsProductsCalculation::className(), ['id_calculation_type' => 'id']);
    }

}
