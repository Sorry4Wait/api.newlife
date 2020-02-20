<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "admin_roles".
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uz
 *
 * @property AdminUsers[] $adminUsers
 */
class AdminRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_uz'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => Yii::t('messages','Name Ru'),
            'name_uz' => Yii::t('messages','Name Uz'),
        ];
    }

}
