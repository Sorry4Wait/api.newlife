<?php

namespace app\modules\icase\models;

use Yii;
use kartik\tree\models\Tree;

/**
 * This is the model class for table "ins_classification".
 *
 * @property int $id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $name
 * @property string $icon
 * @property int $icon_type
 * @property int $active
 * @property int $selected
 * @property int $disabled
 * @property int $readonly
 * @property int $visible
 * @property int $collapsed
 * @property int $movable_u
 * @property int $movable_d
 * @property int $movable_l
 * @property int $movable_r
 * @property int $removable
 * @property int $removable_all
 * @property int $child_allowed
 *
 * @property InsProductsClassification[] $insProductsClassifications
 */
class InsClassification extends Tree
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_classification';
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
            'id' => 'ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'name' => 'Name',
            'icon' => 'Icon',
            'icon_type' => 'Icon Type',
            'active' => 'Active',
            'selected' => 'Selected',
            'disabled' => 'Disabled',
            'readonly' => 'Readonly',
            'visible' => 'Visible',
            'collapsed' => 'Collapsed',
            'movable_u' => 'Movable U',
            'movable_d' => 'Movable D',
            'movable_l' => 'Movable L',
            'movable_r' => 'Movable R',
            'removable' => 'Removable',
            'removable_all' => 'Removable All',
            'child_allowed' => 'Child Allowed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsProductsClassifications()
    {
        return $this->hasMany(InsProductsClassification::className(), ['id_classification' => 'id']);
    }

    public function getClassificationName($id)
    {
        $model = InsClassification::findOne($id);
      //  return $this->getParentName($model->root) . '. ' . $model->name;
        return  $model->name;
    }

    public function getParentName($id)
    {
        $model = InsClassification::findOne($id);
        return $model->name;
    }
}
