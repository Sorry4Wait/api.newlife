<?php

namespace app\modules\icase\models;

use Yii;
use app\models\AdminUsers;

/**
 * This is the model class for table "ins_apphealth_declaration".
 *
 * @property int $id
 * @property int $id_appform
 * @property int $chronic_disease
 * @property string $def_chronic_disease
 * @property int $disability
 * @property int $group_disability
 * @property string $couse_disability
 * @property string $old_disability
 * @property int $doctor_observations
 * @property int $inpatient_treatment
 * @property int $count_inpatient_treatment
 * @property string $placename_treatment
 * @property string $diagnosis_inpatient_treatment
 * @property int $l5_operation
 * @property string $cause_l5_operation
 * @property string $placename_l5_operation
 * @property string $date_completion
 * @property string $create_date
 * @property int $id_admin_users
 *
 * @property AdminUsers $adminUsers
 * @property InsAppformClients $appform
 */
class InsApphealthDeclaration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_apphealth_declaration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_appform', 'id_admin_users'], 'required'],
            [['id_appform', 'chronic_disease', 'disability', 'group_disability', 'doctor_observations', 'inpatient_treatment', 'count_inpatient_treatment', 'l5_operation', 'id_admin_users'], 'default', 'value' => null],
            [['id_appform', 'chronic_disease', 'disability', 'group_disability', 'doctor_observations', 'inpatient_treatment', 'count_inpatient_treatment', 'l5_operation', 'id_admin_users'], 'integer'],
            [['date_completion', 'create_date'], 'safe'],
            [['def_chronic_disease', 'diagnosis_inpatient_treatment', 'placename_l5_operation'], 'string', 'max' => 512],
            [['couse_disability', 'old_disability', 'placename_treatment', 'cause_l5_operation'], 'string', 'max' => 254],
            [['id_admin_users'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUsers::className(), 'targetAttribute' => ['id_admin_users' => 'id']],
            [['id_appform'], 'exist', 'skipOnError' => true, 'targetClass' => InsAppformClients::className(), 'targetAttribute' => ['id_appform' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_appform' => 'Id Appform',
            'chronic_disease' => 'Chronic Disease',
            'def_chronic_disease' => 'Def Chronic Disease',
            'disability' => 'Disability',
            'group_disability' => 'Group Disability',
            'couse_disability' => 'Couse Disability',
            'old_disability' => 'Old Disability',
            'doctor_observations' => 'Doctor Observations',
            'inpatient_treatment' => 'Inpatient Treatment',
            'count_inpatient_treatment' => 'Count Inpatient Treatment',
            'placename_treatment' => 'Placename Treatment',
            'diagnosis_inpatient_treatment' => 'Diagnosis Inpatient Treatment',
            'l5_operation' => 'L5 Operation',
            'cause_l5_operation' => 'Cause L5 Operation',
            'placename_l5_operation' => 'Placename L5 Operation',
            'date_completion' => 'Date Completion',
            'create_date' => 'Create Date',
            'id_admin_users' => 'Id Admin Users',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminUsers()
    {
        return $this->hasOne(AdminUsers::className(), ['id' => 'id_admin_users']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppform()
    {
        return $this->hasOne(InsAppformClients::className(), ['id' => 'id_appform']);
    }
}
