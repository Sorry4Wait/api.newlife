<?php

namespace app\modules\icase\models;

use Yii;
use kartik\tree\models\Tree;

/**
 * This is the model class for table "ins_directory_regions".
 *
 * @property int $id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $name
 * @property string $icon
 * @property int $icon_type
 * @property bool $active
 * @property bool $selected
 * @property bool $disabled
 * @property bool $readonly
 * @property bool $visible
 * @property bool $collapsed
 * @property bool $movable_u
 * @property bool $movable_d
 * @property bool $movable_l
 * @property bool $movable_r
 * @property bool $removable
 * @property bool $removable_all
 * @property bool $child_allowed
 */
class InsDirectoryRegions extends Tree
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_directory_regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'], 'boolean'],
            [['name','name_ru'],'required'],
            [['name','name_ru'], 'string', 'max' => 255],
            [['root', 'lft', 'rgt', 'lvl'],'integer'],
            [['icon'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('messages', 'ID'),
            'root' => Yii::t('messages', 'Root'),
            'lft' => Yii::t('messages', 'Lft'),
            'rgt' => Yii::t('messages', 'Rgt'),
            'lvl' => Yii::t('messages', 'Lvl'),
            'name' => Yii::t('messages', 'Name'),
            'icon' => Yii::t('messages', 'Icon'),
            'icon_type' => Yii::t('messages', 'Icon Type'),
            'active' => Yii::t('messages', 'Active'),
            'selected' => Yii::t('messages', 'Selected'),
            'disabled' => Yii::t('messages', 'Disabled'),
            'readonly' => Yii::t('messages', 'Readonly'),
            'visible' => Yii::t('messages', 'Visible'),
            'collapsed' => Yii::t('messages', 'Collapsed'),
            'movable_u' => Yii::t('messages', 'Movable U'),
            'movable_d' => Yii::t('messages', 'Movable D'),
            'movable_l' => Yii::t('messages', 'Movable L'),
            'movable_r' => Yii::t('messages', 'Movable R'),
            'removable' => Yii::t('messages', 'Removable'),
            'removable_all' => Yii::t('messages', 'Removable All'),
            'child_allowed' => Yii::t('messages', 'Child Allowed'),
        ];
    }
}
