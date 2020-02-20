<?php

namespace app\modules\icase\models;

use Yii;
use app\models\AdminUsers;
use app\modules\directory\models\InsDirectoryPaymentProcedure;

/**
 * This is the model class for table "ins_appform_clients".
 *
 * @property int $id
 * @property int $id_insured_clients
 * @property int $id_insurer_clients
 * @property int $id_beneficiary
 * @property int $sms_notification 0-false, 1-true
 * @property string $first_downpayment_date first down payment date
 * @property int $insurance_fee
 * @property int $id_payment_procedure
 * @property int $id_admin_users
 * @property int $id_department
 * @property string $create_date
 * @property string $date_formation
 * @property int $id_products
 * @property int $app_status 0-created, 1-formulated, 2-created contract, 3-approves, 4-canceled
 * @property int $ins_premium Insurance premium
 * @property int $ins_amount Insurance Amount
 * @property int $ins_amount_survival Insurance amount for survival (for life insurance)
 * @property int $ins_sum_death Sum Insured on Death (for life insurance)
 * @property int $ins_annual_premium Annual insurance premium
 * @property string $ins_period_bdate begin date of insurance period
 * @property string $ins_period_edate End date of insurance period
 * @property string $monthly_com_date date of monthly rent up to 60 years
 * @property string $quarterly_com_date date of quarterly rent until 60 years
 * @property string $semiannual_com_date date of semi-annual rent up to 60 years
 * @property string $annual_com_date date of annual rent up 60 years
 * @property string $annual_com_date_fm date of annual annuity up to 60 years (1 month)
 * @property string $annual_com_date_em date of annual annuity up to 60 years (12 month)
 * @property string $annual_com_date_as date of the annual rent after reaching 60 years
 * @property int $monthly_com_payment The amount of monthly rental payments up to 60 years
 * @property int $quarterly_com_payment The size of quarterly rental payments up to 60 years
 * @property int $semiannual_com_payment The size of semi-annual rental payments up to 60 years
 * @property int $annual_com_payment The size of annual rental payments up to 60 years
 * @property int $annual_com_payment_fm The amount of annual rental payments up to 60 years (1 month)
 * @property int $annual_com_payment_em The amount of annual rental payments up to 60 years (12 months)
 * @property int $annual_com_payment_as The amount of annual rental payments after reaching 60 years
 *
 * @property AdminUsers $adminUsers
 * @property InsDirectoryPaymentProcedure $paymentProcedure
 * @property InsInsuredClients $insuredClients
 * @property InsProducts $products
 * @property InsApphealthDeclaration[] $insApphealthDeclarations
 */
class InsAppformClients extends \yii\db\ActiveRecord
{

    public $address;
    public $address2;
    public $phone;
    public $email;
    public $work_place;
    public $inn;
    public $productsAppForm;
    public $array_ids;

    const CASE_INSURED = 1;
    const CASE_INSURER = 2;
    const CASE_BENEFICIARY = 3;
    const CASE_INSURANCE_PERIOD = 4;
    const CASE_SMS_NOTIFICATION = 5;
    const CASE_INSURANCE_FREE = 6;
    const CASE_PAYMENT_METHOD = 7;
    const CASE_ACQUAINTANCE_RULE = 8;
    const CASE_DATE_FORMATION = 9;
    const CASE_INS_PREMIUM = 11;
    const CASE_INS_AMOUNT = 12;
    const CASE_INS_AMOUNT_SURVIVAL = 13;
    const CASE_INS_SUM_DEATH = 14;
    const CASE_INS_ANNUAL_PREMIUM = 15;
    const CASE_COMMENCEMENT_DATE = 16;

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
            // ['inn', 'unique','targetClass' => '\app\modules\icase\models\InsInsuredClients'],
//            ['inn', 'unique',
//                'targetClass' => 'app\modules\icase\models\InsInsuredClients',
//                'message' => \Yii::t('messages', 'Error'),
//                'when' => function ($model, $attribute) {
//                    return $model->{$attribute} !== $model->getOldAttribute($attribute);
//                }, 'whenClient' => "function (attribute, value){
//                 return $('#insappformclients-inn').val() !== '';
//            }"
//            ],
//            [['inn'], 'string', 'min' => 9, 'max' => 9],
            [['id_insured_clients', 'address', 'work_place', 'inn', 'phone', 'email', 'id_insurer_clients', 'address2', 'sms_notification', 'insurance_fee'], 'required'],
            [['id_insured_clients', 'id_insurer_clients', 'id_beneficiary', 'sms_notification', 'insurance_fee', 'id_payment_procedure', 'id_admin_users', 'id_department', 'id_products', 'app_status', 'ins_premium', 'ins_amount', 'ins_amount_survival', 'ins_sum_death', 'ins_annual_premium', 'monthly_com_payment', 'quarterly_com_payment', 'semiannual_com_payment', 'annual_com_payment', 'annual_com_payment_fm', 'annual_com_payment_em', 'annual_com_payment_as'], 'default', 'value' => null],
            [['id_insured_clients', 'id_insurer_clients', 'id_beneficiary', 'sms_notification', 'id_payment_procedure', 'id_admin_users', 'id_department', 'id_products', 'app_status', 'ins_premium', 'ins_amount', 'ins_amount_survival', 'ins_sum_death', 'ins_annual_premium', 'monthly_com_payment', 'quarterly_com_payment', 'semiannual_com_payment', 'annual_com_payment', 'annual_com_payment_fm', 'annual_com_payment_em', 'annual_com_payment_as'], 'integer'],
            [['first_downpayment_date', 'create_date', 'date_formation', 'monthly_com_date', 'quarterly_com_date', 'semiannual_com_date', 'annual_com_date', 'annual_com_date_fm', 'annual_com_date_em', 'annual_com_date_as', 'array_ids'], 'safe'],

            ['email', 'email'],
            [['id_admin_users'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUsers::className(), 'targetAttribute' => ['id_admin_users' => 'id']],
            [['id_payment_procedure'], 'exist', 'skipOnError' => true, 'targetClass' => InsDirectoryPaymentProcedure::className(), 'targetAttribute' => ['id_payment_procedure' => 'id']],
            [['id_insured_clients'], 'exist', 'skipOnError' => true, 'targetClass' => InsInsuredClients::className(), 'targetAttribute' => ['id_insured_clients' => 'id']],
            [['id_products'], 'exist', 'skipOnError' => true, 'targetClass' => InsProducts::className(), 'targetAttribute' => ['id_products' => 'id']],

            [['id_beneficiary'], 'required', 'when' => function ($model) {
                $ids = explode(",", $model->array_ids);
                return in_array((string)self::CASE_BENEFICIARY, $ids);
            }, 'whenClient' => "function (attribute, value) {
                let str = $('#insappformclients-array_ids').val();
                str = str.split(',');
                 return str.includes('" . self::CASE_BENEFICIARY . "');
            }"],


            [['ins_period_bdate', 'ins_period_edate', 'first_downpayment_date'], 'required', 'when' => function ($model) {
                $ids = explode(",", $model->array_ids);
                return in_array((string)self::CASE_INSURANCE_PERIOD, $ids);
            }, 'whenClient' => "function (attribute, value) {
                let str = $('#insappformclients-array_ids').val();
                str = str.split(',');
                 return str.includes('" . self::CASE_INSURANCE_PERIOD . "');
            }"],

            [['id_payment_procedure'], 'required', 'when' => function ($model) {
                $ids = explode(",", $model->array_ids);
                return in_array((string)self::CASE_PAYMENT_METHOD, $ids);
            }, 'whenClient' => "function (attribute, value) {
                let str = $('#insappformclients-array_ids').val();
                str = str.split(',');
                 return str.includes('" . self::CASE_PAYMENT_METHOD . "');
            }"],

            [['date_formation'], 'required', 'when' => function ($model) {
                $ids = explode(",", $model->array_ids);
                return in_array((string)self::CASE_DATE_FORMATION, $ids);
            }, 'whenClient' => "function (attribute, value) {
                let str = $('#insappformclients-array_ids').val();
                str = str.split(',');
                 return str.includes('" . self::CASE_DATE_FORMATION . "');
            }"],


        ];
    }


    public function beforeSave($insert)
    {
        Yii::$app->formatter->nullDisplay = '';
        $this->first_downpayment_date = Yii::$app->formatter->asDate($this->first_downpayment_date, 'yyyy-MM-dd');
        $this->date_formation = Yii::$app->formatter->asDate($this->date_formation, 'yyyy-MM-dd');
        $this->ins_period_bdate = Yii::$app->formatter->asDate($this->ins_period_bdate, 'yyyy-MM-dd');
        $this->ins_period_edate = Yii::$app->formatter->asDate($this->ins_period_edate, 'yyyy-MM-dd');
        $this->monthly_com_date = Yii::$app->formatter->asDate($this->monthly_com_date, 'yyyy-MM-dd');
        $this->quarterly_com_date = Yii::$app->formatter->asDate($this->quarterly_com_date, 'yyyy-MM-dd');
        $this->semiannual_com_date = Yii::$app->formatter->asDate($this->semiannual_com_date, 'yyyy-MM-dd');
        $this->annual_com_date = Yii::$app->formatter->asDate($this->annual_com_date, 'yyyy-MM-dd');
        $this->annual_com_date_fm = Yii::$app->formatter->asDate($this->annual_com_date_fm, 'yyyy-MM-dd');
        $this->annual_com_date_em = Yii::$app->formatter->asDate($this->annual_com_date_em, 'yyyy-MM-dd');
        $this->annual_com_date_as = Yii::$app->formatter->asDate($this->annual_com_date_as, 'yyyy-MM-dd');
        parent::beforeSave($insert);
        return true;
    }

    public function afterFind()
    {
        Yii::$app->formatter->nullDisplay = '';
        $this->first_downpayment_date = Yii::$app->formatter->asDate($this->first_downpayment_date, 'dd.MM.yyyy');
        $this->date_formation = Yii::$app->formatter->asDate($this->date_formation, 'dd.MM.yyyy');
        $this->ins_period_bdate = Yii::$app->formatter->asDate($this->ins_period_bdate, 'dd.MM.yyyy');
        $this->ins_period_edate = Yii::$app->formatter->asDate($this->ins_period_edate, 'dd.MM.yyyy');
        $this->monthly_com_date = Yii::$app->formatter->asDate($this->monthly_com_date, 'dd.MM.yyyy');
        $this->quarterly_com_date = Yii::$app->formatter->asDate($this->quarterly_com_date, 'dd.MM.yyyy');
        $this->semiannual_com_date = Yii::$app->formatter->asDate($this->semiannual_com_date, 'dd.MM.yyyy');
        $this->annual_com_date = Yii::$app->formatter->asDate($this->annual_com_date, 'dd.MM.yyyy');
        $this->annual_com_date_fm = Yii::$app->formatter->asDate($this->annual_com_date_fm, 'dd.MM.yyyy');
        $this->annual_com_date_em = Yii::$app->formatter->asDate($this->annual_com_date_em, 'dd.MM.yyyy');
        $this->annual_com_date_as = Yii::$app->formatter->asDate($this->annual_com_date_as, 'dd.MM.yyyy');
        parent::afterFind();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_insured_clients' => Yii::t('messages', 'Insured Clients'),
            'id_insurer_clients' => Yii::t('messages', 'Insurer Clients'),
            'id_beneficiary' => Yii::t('messages', 'Beneficiary'),
            'sms_notification' => Yii::t('messages', 'Notification'),
            'first_downpayment_date' => Yii::t('messages', 'First Downpayment Date'),
            'insurance_fee' => Yii::t('messages', 'Insurance Fee'),
            'id_payment_procedure' => Yii::t('messages', 'Payment Procedure'),
            'id_admin_users' => Yii::t('messages', 'Admin Users'),
            'id_department' => Yii::t('messages', 'Department'),
            'create_date' => Yii::t('messages', 'Create Date'),
            'date_formation' => Yii::t('messages', 'Date Formation'),
            'id_products' => Yii::t('messages', 'List of Products'),
            'app_status' => Yii::t('messages', 'Status'),
            'ins_premium' => Yii::t('messages', 'Premium'),
            'ins_amount' => Yii::t('messages', 'Amount'),
            'ins_amount_survival' => Yii::t('messages', 'Amount Survival'),
            'ins_sum_death' => Yii::t('messages', 'Sum Death'),
            'ins_annual_premium' => Yii::t('messages', 'Annual Premium'),
            'ins_period_bdate' => Yii::t('messages', 'Period Bdate'),
            'ins_period_edate' => Yii::t('messages', 'Period Edate'),
            'monthly_com_date' => Yii::t('messages', 'Monthly Com Date'),
            'quarterly_com_date' => Yii::t('messages', 'Quarterly Com Date'),
            'semiannual_com_date' => Yii::t('messages', 'Semiannual Com Date'),
            'annual_com_date' => Yii::t('messages', 'Annual Com Date'),
            'annual_com_date_fm' => Yii::t('messages', 'Annual Com Date Fm'),
            'annual_com_date_em' => Yii::t('messages', 'Annual Com Date Em'),
            'annual_com_date_as' => Yii::t('messages', 'Annual Com Date As'),
            'monthly_com_payment' => Yii::t('messages', 'Monthly Com Payment'),
            'quarterly_com_payment' => Yii::t('messages', 'Quarterly Com Payment'),
            'semiannual_com_payment' => Yii::t('messages', 'Semiannual Com Payment'),
            'annual_com_payment' => Yii::t('messages', 'Annual Com Payment'),
            'annual_com_payment_fm' => Yii::t('messages', 'Annual Com Payment Fm'),
            'annual_com_payment_em' => Yii::t('messages', 'Annual Com Payment Em'),
            'annual_com_payment_as' => Yii::t('messages', 'Annual Com Payment As'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsApphealthDeclarations()
    {
        return $this->hasMany(InsApphealthDeclaration::className(), ['id_appform' => 'id']);
    }

    public function getConnectedAppForms()
    {
        $str = '';
        $array_of_ids = InsProductsAppform::find()->select('id_directory_appform')->where(['id_ins_products' => $this->productsAppForm])->asArray()->all();

        foreach ($array_of_ids as $item) {
            $str .= $item['id_directory_appform'] . ",";
        }


        $this->array_ids = $str;
    }

    protected function checkInArray($id)
    {

    }
}
