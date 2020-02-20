<?php

namespace app\modules\v1\models;

use DateTime;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use sizeg\jwt\Jwt;
use Yii;
use yii\web\UnauthorizedHttpException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string|null $last_name
 * @property int|null $current_position_id
 * @property int|null $department_id
 * @property int|null $status 1-active
 * 2-inactive
 * @property string|null $last_login_date
 * @property string $created_at
 * @property int|null $employee_id
 * @property string|null $token
 * @property string|null $updated_at
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->setPassword($this->password);
                $this->created_at = date("Y-m-d H:i:s");
                $this->updated_at = date("Y-m-d H:i:s");
                $this->last_login_date = date("Y-m-d H:i:s");
                $this->generateToken();
            } else {
                $this->updated_at = date("Y-m-d H:i:s");
            }

            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'first_name'], 'required'],
            [['current_position_id', 'department_id', 'status', 'employee_id'], 'default', 'value' => null],
            [['current_position_id', 'department_id', 'status', 'employee_id'], 'integer'],
            [['last_login_date', 'created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['password', 'token'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            '$username' => 'Username',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'current_position_id' => 'Current Position ID',
            'department_id' => 'Department ID',
            'status' => 'Status',
            'last_login_date' => 'Last Login Date',
            'created_at' => 'Created At',
            'employee_id' => 'Employee ID',
            'token' => 'Token',
            'updated_at' => 'Updated At',
        ];
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

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    protected function setPassword($password)
    {
        $this->password = md5($password);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
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

//    public function generateToken()
//    {
//        $this->token = \Yii::$app->security->generateRandomString();
//    }

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
