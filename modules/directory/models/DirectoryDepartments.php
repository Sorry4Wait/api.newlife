<?php

namespace app\modules\directory\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "directory_departments".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name_uz
 * @property string $name_ru
 */
class DirectoryDepartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directory_departments';
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
            'parent_id' => 'Parent ID',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
        ];
    }

    public static function getDepartments(){
        $departments = DirectoryDepartments::find('parent_id', \Yii::$app->user->identity->department_id)->all();
        return $items = ArrayHelper::map($departments, 'id', 'name_ru');
    }
}
