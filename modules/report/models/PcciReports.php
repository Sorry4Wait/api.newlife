<?php

namespace app\modules\report\models;

use Yii;

/**
 * This is the model class for table "pcci_reports".
 *
 * @property int $id
 * @property int $department_id
 * @property string $report_name
 * @property string $create_date
 * @property int $creator_id
 *
 * @property PcciReportsLink[] $pcciReportsLinks
 */
class PcciReports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcci_reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'report_name', 'creator_id'], 'required'],
            [['department_id', 'creator_id'], 'default', 'value' => null],
            [['department_id', 'creator_id'], 'integer'],
            [['create_date'], 'safe'],
            [['report_name'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'report_name' => 'Report Name',
            'create_date' => 'Create Date',
            'creator_id' => 'Creator ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcciReportsLinks()
    {
        return $this->hasMany(PcciReportsLink::className(), ['reports_id' => 'id']);
    }
}
