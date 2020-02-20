<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the model class for table "ins_directory_departcodes".
 *
 * @property int $id_department
 * @property string $code
 */
class InsDirectoryDepartcodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_departcodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_department', 'code'], 'required'],
            [['id_department'], 'default', 'value' => null],
            [['id_department'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['id_department', 'code'], 'unique', 'targetAttribute' => ['id_department', 'code']],
            [['id_department'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_department' => Yii::t('messages', 'Department'),
            'code' => Yii::t('messages', 'Code'),
        ];
    }
}
