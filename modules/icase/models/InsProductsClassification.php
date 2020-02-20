<?php

namespace app\modules\icase\models;

use Yii;

/**
 * This is the model class for table "ins_products_classification".
 *
 * @property int $id
 * @property int $id_products
 * @property int $id_classification
 * @property int $ismain 0-isDefault
 * 1-main
 *
 * @property InsClassification $classification
 * @property InsProducts $products
 */
class InsProductsClassification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_products_classification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_products', 'id_classification','ismain'], 'required'],
            [['id_products', 'id_classification', 'ismain'], 'default', 'value' => null],
            [['id_products', 'id_classification', 'ismain'], 'integer'],
            [['id_classification'], 'exist', 'skipOnError' => true, 'targetClass' => InsClassification::className(), 'targetAttribute' => ['id_classification' => 'id']],
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
            'id_classification' => Yii::t('messages', 'Classification'),
            'ismain' => Yii::t('messages', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassification()
    {
        return $this->hasOne(InsClassification::className(), ['id' => 'id_classification']);
    }

    /**`
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(InsProducts::className(), ['id' => 'id_products']);
    }

}
