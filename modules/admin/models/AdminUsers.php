<?php

namespace app\modules\admin\models;

use app\modules\directory\models\InsDirectoryDepartments;
use Yii;

/**
 * This is the model class for table "admin_users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int $current_position_id
 * @property int $department_id
 * @property int $status 1-active
 * 2-inactive
 * @property string $last_login_date
 * @property string $create_date
 * @property int $employee_id
 *
 * @property AdminRoles $adminRole
 * @property InsDirectoryDepartments $departments
 * @property InsInsuredLegalClients[] $insInsuredLegalClients
 */
class AdminUsers extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    private $authKey;
    public $confirm_password;
    public $roles = [];
    const SCENARIO_CREATE  = 'create';
    const SCENARIO_UPDATE  = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'first_name', 'last_name', 'department_id'], 'required'],
            [['current_position_id', 'department_id', 'status', 'employee_id'], 'default', 'value' => null],
            [['current_position_id', 'department_id', 'status', 'employee_id'], 'integer'],
            [['last_login_date', 'create_date','roles'], 'safe'],
            [['password','confirm_password'], 'required','on' =>self::SCENARIO_CREATE],
            ['confirm_password', 'required', 'when' => function ($model) {
                return !empty($model->password);
            }, 'whenClient' => "function (attribute, value) {
                return $('#users-password').val() !== '';
            }", 'on' => self::SCENARIO_UPDATE],
            ['confirm_password', 'compare', 'compareAttribute'=> 'password', 'message'=>Yii::t('messages', "The password and confirm password do not match.")],
            [['login'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['login', 'employee_id'], 'unique', 'targetAttribute' => ['login', 'employee_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('messages','User ID'),
            'login' => Yii::t('messages','Login'),
            'password' =>  Yii::t('messages','Password'),
            'first_name' => Yii::t('messages','First Name'),
            'last_name' => Yii::t('messages','Last Name'),
            'current_position_id' => Yii::t('messages','Current Position'),
            'department_id' => Yii::t('messages','Department'),
            'status' => Yii::t('messages','Status'),
            'last_login_date' => Yii::t('messages','Last Login Date'),
            'create_date' => Yii::t('messages','Create Date'),
            'employee_id' => Yii::t('messages','Employee'),
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->setPassword($this->password);
            $this->status = 1;

            return true;
        } else {
            return false;
        }
    }

    public static function findByUsername($username)
    {
        return self::findOne(['login' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public static function findIdentity($login)
    {
        $user = AdminUsers::findByUsername($login);
        if (!empty($user)) {
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getId()
    {
        return $this->login;
    }

    public static function getPermissions($id)
    {
        $permissions =  \app\modules\admin\models\AuthAssignment::find()->select('item_name')->where(['user_id' => $id])->asArray()->all();
        if(!empty($permissions)){
            $perms = [];

            foreach ($permissions as $perm){
                array_push($perms,$perm['item_name']);
            }

            return $perms;
        }

        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasOne(InsDirectoryDepartments::className(), ['id' => 'department_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsInsuredLegalClients()
    {
        return $this->hasMany(InsInsuredLegalClients::className(), ['who_create' => 'id']);
    }

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
