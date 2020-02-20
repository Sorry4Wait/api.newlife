<?php

namespace app\modules\icase\models;

use Yii;
use app\models\AdminUsers;
use app\modules\directory\models\InsDirectoryPaymentProcedure;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ins_appform_clients".
 *
 * @property int $id
 * @property int $id_insured_clients
 * @property int $id_insurer_clients
 * @property int $id_beneficiary
 * @property int $sms_notification 0-false, 1-true
 * @property string $first_downpayment_date first down payment date
 * @property int $insurance_period how many month
 * @property int $insurance_fee
 * @property int $id_payment_procedure
 * @property int $id_admin_users
 * @property int $id_department
 * @property string $create_date
 * @property string $date_formation
 * @property int $id_products
 * @property int $app_status 0-created, 1-formulated, 2-created contract, 3-approves, 4-canceled
 *
 * @property AdminUsers $adminUsers
 * @property InsDirectoryPaymentProcedure $paymentProcedure
 * @property InsInsuredClients $insuredClients
 * @property InsProducts $products
 */
class InsAppformClients extends \yii\db\ActiveRecord
{
    public $address;
    public $address2;
    public $phone;
    public $email;
    public $work_place;
    public $inn;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_appform_clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_insured_clients', 'first_downpayment_date', 'id_payment_procedure', 'id_admin_users', 'id_department', 'id_products', 'address', 'address2', 'phone', 'email', 'work_place'], 'required'],
            [['id_insured_clients', 'id_insurer_clients', 'id_beneficiary', 'sms_notification', 'insurance_period', 'insurance_fee', 'id_payment_procedure', 'id_admin_users', 'id_department', 'id_products', 'app_status'], 'default', 'value' => null],
            [['id_insured_clients', 'id_insurer_clients', 'id_beneficiary', 'sms_notification', 'insurance_period', 'insurance_fee', 'id_payment_procedure', 'id_admin_users', 'id_department', 'id_products', 'app_status'], 'integer'],
            [['first_downpayment_date', 'create_date', 'date_formation'], 'safe'],
            [['id_admin_users'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUsers::className(), 'targetAttribute' => ['id_admin_users' => 'id']],
            [['id_payment_procedure'], 'exist', 'skipOnError' => true, 'targetClass' => InsDirectoryPaymentProcedure::className(), 'targetAttribute' => ['id_payment_procedure' => 'id']],
            [['id_insured_clients'], 'exist', 'skipOnError' => true, 'targetClass' => InsInsuredClients::className(), 'targetAttribute' => ['id_insured_clients' => 'id']],
            [['id_products'], 'exist', 'skipOnError' => true, 'targetClass' => InsProducts::className(), 'targetAttribute' => ['id_products' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_insured_clients' => 'Id Insured Clients',
            'id_insurer_clients' => 'Id Insurer Clients',
            'id_beneficiary' => 'Id Beneficiary',
            'sms_notification' => '0-false, 1-true',
            'first_downpayment_date' => 'first down payment date',
            'insurance_period' => 'how many month',
            'insurance_fee' => 'Insurance Fee',
            'id_payment_procedure' => 'Id Payment Procedure',
            'id_admin_users' => 'Id Admin Users',
            'id_department' => 'Id Department',
            'create_date' => 'Create Date',
            'date_formation' => 'Date Formation',
            'id_products' => 'Id Products',
            'app_status' => 'Status',
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
    public function getPaymentProcedure()
    {
        return $this->hasOne(InsDirectoryPaymentProcedure::className(), ['id' => 'id_payment_procedure']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsuredClients()
    {
        return $this->hasOne(InsInsuredClients::className(), ['id' => 'id_insured_clients']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(InsProducts::className(), ['id' => 'id_products']);
    }

}
