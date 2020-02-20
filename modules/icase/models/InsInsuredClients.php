<?php

namespace app\modules\icase\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ins_insured_clients".
 *
 * @property int $id
 * @property string $document
 * @property string $pinpp
 * @property int $lang_id
 * @property string $name_latin
 * @property string $surname_latin
 * @property string $patronym_latin
 * @property string $name_engl
 * @property string $surname_engl
 * @property string $birth_date
 * @property string $birth_place
 * @property int $birth_place_id
 * @property string $birth_country
 * @property int $birth_country_id
 * @property int $livestatus 1-life, 2-dead
 * @property string $nationality
 * @property int $nationality_id
 * @property string $citizenship
 * @property int $citizenship_id
 * @property int $sex 1-man, 2-woman
 * @property string $doc_give_place
 * @property int $doc_give_place_id
 * @property string $date_begin_document
 * @property string $date_end_document
 * @property string $inn
 * @property int $who_registred
 * @property string $create_date
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property int $citizen_status 1-citizen,2-not citizen,3-not resident
 * @property string $work_place
 *
 * @property InsAppformClients[] $insAppformClients
 */
class InsInsuredClients extends \yii\db\ActiveRecord
{
    const SCENARIO_CITIZEN  = 'citizen';
    const SCENARIO_NOT_CITIZEN  = 'not_citizen';
    const SCENARIO_NOT_RESIDENT  = 'not_resident';
    public $pass_serial;
    public $pass_number;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_date', false],
                    ActiveRecord::EVENT_BEFORE_UPDATE => false,
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ins_insured_clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document','pinpp','inn','birth_date','date_begin_document','date_end_document','name_latin','surname_latin','patronym_latin','birth_place_id','birth_date'], 'required'],
            [['lang_id', 'birth_place_id', 'birth_country_id', 'livestatus', 'nationality_id', 'citizenship_id', 'sex', 'doc_give_place_id', 'who_registred', 'citizen_status'], 'default', 'value' => null],
            [['lang_id', 'birth_place_id', 'birth_country_id', 'livestatus', 'nationality_id', 'citizenship_id', 'sex', 'doc_give_place_id', 'who_registred', 'citizen_status'], 'integer'],
            [['birth_date', 'date_begin_document', 'date_end_document', 'create_date'], 'safe'],
            [['document', 'inn'], 'string', 'max' => 9],
            [['pinpp'], 'string', 'max' => 14],
            [['name_latin', 'surname_latin', 'patronym_latin', 'name_engl', 'surname_engl'], 'string', 'max' => 50],
            [['birth_place', 'nationality'], 'string', 'max' => 100],
            [['birth_country'], 'string', 'max' => 150],
            [['citizenship', 'phone'], 'string', 'max' => 30],
            [['doc_give_place', 'address', 'work_place'], 'string', 'max' => 512],
            [['email'], 'email'],
            [['inn'], 'unique'],
            [['pinpp'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('messages', 'ID'),
            'document' => Yii::t('messages', 'Document'),
            'pinpp' => Yii::t('messages', 'Pinpp'),
            'lang_id' => Yii::t('messages', 'Lang ID'),
            'name_latin' => Yii::t('messages', 'Name Latin'),
            'surname_latin' => Yii::t('messages', 'Surname Latin'),
            'patronym_latin' => Yii::t('messages', 'Patronym Latin'),
            'name_engl' => Yii::t('messages', 'Name Engl'),
            'surname_engl' => Yii::t('messages', 'Surname Engl'),
            'birth_date' => Yii::t('messages', 'Birth Date'),
            'birth_place' => Yii::t('messages', 'Birth Place'),
            'birth_place_id' => Yii::t('messages', 'Birth Place ID'),
            'birth_country' => Yii::t('messages', 'Birth Country'),
            'birth_country_id' => Yii::t('messages', 'Birth Country ID'),
            'livestatus' => Yii::t('messages', 'Livestatus'),
            'nationality' => Yii::t('messages', 'Nationality'),
            'nationality_id' => Yii::t('messages', 'Nationality ID'),
            'citizenship' => Yii::t('messages', 'Citizenship'),
            'citizenship_id' => Yii::t('messages', 'Citizenship ID'),
            'sex' => Yii::t('messages', 'Sex'),
            'doc_give_place' => Yii::t('messages', 'Doc Give Place'),
            'doc_give_place_id' => Yii::t('messages', 'Doc Give Place ID'),
            'date_begin_document' => Yii::t('messages', 'Date Begin Document'),
            'date_end_document' => Yii::t('messages', 'Date End Document'),
            'inn' => Yii::t('messages', 'Inn'),
            'who_registred' => Yii::t('messages', 'Who Registred'),
            'create_date' => Yii::t('messages', 'Create Date'),
            'address' => Yii::t('messages', 'Address'),
            'phone' => Yii::t('messages', 'Phone'),
            'email' => Yii::t('messages', 'Email'),
            'citizen_status' => Yii::t('messages', 'Citizen Status'),
            'work_place' => Yii::t('messages', 'Work Place'),
        ];
    }

    public function beforeSave($insert)
    {
        Yii::$app->formatter->nullDisplay = '';
        $this->birth_date = Yii::$app->formatter->asDate($this->birth_date, 'yyyy-MM-dd');
        $this->date_begin_document = Yii::$app->formatter->asDate($this->date_begin_document, 'yyyy-MM-dd');
        $this->date_end_document = Yii::$app->formatter->asDate($this->date_end_document, 'yyyy-MM-dd');

        parent::beforeSave($insert);
        return true;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsAppformClients()
    {
        return $this->hasMany(InsAppformClients::className(), ['id_insured_clients' => 'id']);
    }
}
