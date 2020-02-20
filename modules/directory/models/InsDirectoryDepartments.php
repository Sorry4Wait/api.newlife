<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_departments".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name_uz
 * @property string $name_ru
 */
class InsDirectoryDepartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'parent_id'], 'default', 'value' => null],
            [['id', 'parent_id'], 'integer'],
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
            'parent_id' => Yii::t('messages', 'Parent'),
            'name_uz' => Yii::t('messages', 'Name Uz'),
            'name_ru' => Yii::t('messages', 'Name Ru'),
        ];
    }
}
