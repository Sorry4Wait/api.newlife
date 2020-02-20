<?php

namespace app\models;

use app\modules\icase\models\InsAppformClients;
use app\modules\icase\models\InsApphealthDeclaration;
use sizeg\jwt\Jwt;
use Yii;
use yii\web\IdentityInterface;
use yii\web\UnauthorizedHttpException;

/**
 * This is the model class for table "admin_users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int|null $current_position_id
 * @property int $department_id
 * @property int $status 1-active
 * 2-inactive
 * @property string|null $last_login_date
 * @property string $create_date
 * @property int|null $employee_id
 *
 * @property InsAppformClients[] $insAppformClients
 * @property InsAppformClients[] $insAppformClients0
 * @property InsApphealthDeclaration[] $insApphealthDeclarations
 * @property InsInsuredLegalClients[] $insInsuredLegalClients
 */
class AdminUsers extends \yii\db\ActiveRecord implements IdentityInterface
{
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
            [['last_login_date', 'create_date'], 'safe'],
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
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'current_position_id' => 'Current Position ID',
            'department_id' => 'Department ID',
            'status' => 'Status',
            'last_login_date' => 'Last Login Date',
            'create_date' => 'Create Date',
            'employee_id' => 'Employee ID',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->status = 1;
                $this->setPassword($this->password);
                $this->create_date = date("Y-m-d H:i:s");
                $this->last_login_date = date("Y-m-d H:i:s");
            }

            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        if ($token->getClaim('exp') - time() > 0) {
            return self::findIdentity($token->getClaim('uid'));
        } else {
            throw new UnauthorizedHttpException();
        }

    }

    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    protected function setPassword($password)
    {
        $this->password = md5($password);
    }

    /**
     * Gets query for [[InsAppformClients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsAppformClients()
    {
        return $this->hasMany(InsAppformClients::className(), ['id_admin_users' => 'id']);
    }

    /**
     * Gets query for [[InsAppformClients0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsAppformClients0()
    {
        return $this->hasMany(InsAppformClients::className(), ['id_admin_users' => 'id']);
    }

    /**
     * Gets query for [[InsApphealthDeclarations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsApphealthDeclarations()
    {
        return $this->hasMany(InsApphealthDeclaration::className(), ['id_admin_users' => 'id']);
    }

    /**
     * Gets query for [[InsInsuredLegalClients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsInsuredLegalClients()
    {
        return $this->hasMany(InsInsuredLegalClients::className(), ['who_create' => 'id']);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return true;
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }

    public static function generateToken($id)
    {
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $token = $jwt->getBuilder()
            ->setIssuer('http://nl.dataprizma.uz')// Configures the issuer (iss claim)
            ->setAudience('http://nl.dataprizma.uz')// Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
            ->setExpiration(time() + 3600 * 24)// Configures the expiration time of the token (exp claim)
            ->set('uid', $id)// Configures a new claim, called "uid"
            ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
            ->getToken(); // Retrieves the generated token

        return $token;
    }
}
