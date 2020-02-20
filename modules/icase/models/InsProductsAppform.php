<?php

namespace app\modules\icase\models;

use Yii;
use app\modules\directory\models\InsDirectoryAppform;

/**
 * This is the model class for table "ins_products_appform".
 *
 * @property int $id
 * @property int $id_ins_products
 * @property int $id_directory_appform
 *
 * @property InsDirectoryAppform $directoryAppform
 * @property InsProducts $insProducts
 */
class InsProductsAppform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_products_appform';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ins_products', 'id_directory_appform'], 'required'],
            [['id_ins_products', 'id_directory_appform'], 'default', 'value' => null],
            [['id_ins_products', 'id_directory_appform'], 'integer'],
            [['id_ins_products', 'id_directory_appform'], 'unique', 'targetAttribute' => ['id_ins_products', 'id_directory_appform']],
            [['id_directory_appform'], 'exist', 'skipOnError' => true, 'targetClass' => InsDirectoryAppform::className(), 'targetAttribute' => ['id_directory_appform' => 'id']],
            [['id_ins_products'], 'exist', 'skipOnError' => true, 'targetClass' => InsProducts::className(), 'targetAttribute' => ['id_ins_products' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ins_products' => Yii::t('messages', 'Products'),
            'id_directory_appform' => Yii::t('messages', 'Application Form'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectoryAppform()
    {
        return $this->hasOne(InsDirectoryAppform::className(), ['id' => 'id_directory_appform']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProducts()
    {
        return $this->hasOne(InsProducts::className(), ['id' => 'id_ins_products']);
    }

    public function checkIfNotExists($id,$row)
    {
        $model = self::find()->where(['id_ins_product' => $id])->andWhere(['id_directory_appform' => $row]);

        return $model ? true : false;
    }

}
