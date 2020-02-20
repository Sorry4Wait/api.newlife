<?php

namespace app\modules\icase\models;

use Yii;
use app\modules\directory\models\InsDirectoryCalculationType;

/**
 * This is the model class for table "ins_products_calculation".
 *
 * @property int $id
 * @property int $id_products
 * @property int $id_calculation_type
 * @property int $calculation_percentage
 *
 * @property InsDirectoryCalculationType $calculationType
 * @property InsProducts $products
 */
class InsProductsCalculation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_products_calculation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_products', 'id_calculation_type','calculation_percentage'], 'required'],
            [['id_products', 'id_calculation_type', 'calculation_percentage'], 'default', 'value' => null],
            [['id_products', 'id_calculation_type', 'calculation_percentage'], 'integer'],
            [['id_calculation_type'], 'exist', 'skipOnError' => true, 'targetClass' => InsDirectoryCalculationType::className(), 'targetAttribute' => ['id_calculation_type' => 'id']],
            [['id_products'], 'exist', 'skipOnError' => true, 'targetClass' => InsProducts::className(), 'targetAttribute' => ['id_products' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_products' => Yii::t('messages', 'List of Products'),
            'id_calculation_type' => Yii::t('messages', 'Type of Calculation'),
            'calculation_percentage' => Yii::t('messages', 'Percentage'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalculationType()
    {
        return $this->hasOne(InsDirectoryCalculationType::className(), ['id' => 'id_calculation_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(InsProducts::className(), ['id' => 'id_products']);
    }
}
