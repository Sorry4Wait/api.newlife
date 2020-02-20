<?php

namespace app\modules\directory\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ins_directory_product_kind".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property InsProducts[] $insProducts
 */
class InsDirectoryProductKind extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_product_kind';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'required'],
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
        return $this->hasMany(InsProducts::className(), ['id_product_kind' => 'id']);
    }

    public static function getProductKinds(){
        $kinds = InsDirectoryProductKind::find()->all();
        return $items = ArrayHelper::map($kinds, 'id', 'name_ru');
    }
}
