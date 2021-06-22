<?php

namespace common\models;

use backend\models\Wishlist;
use backend\modules\edu\models\Student;
use backend\modules\edu\models\Tutor;
use backend\modules\edu\models\TutorGroup;
use frontend\models\Product;
use Yii;
use backend\modules\edu\models\Um;
use soft\helpers\ArrayHelper;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property string $code
 * @property string $name
 * @property string $auth_key
 * @property integer $status
 * @property integer $verify_time
 * @property integer $created_at
 * @property integer $updated_at
 * @property-read string $authKey
 * @property string $password write-only password
 * @property string $Trigger_priv [enum('N', 'Y')]
 * @property string $Host [char(60)]
 * @property string $User [char(32)]
 * @property string $Select_priv [enum('N', 'Y')]
 * @property string $Insert_priv [enum('N', 'Y')]
 * @property string $Update_priv [enum('N', 'Y')]
 * @property string $Delete_priv [enum('N', 'Y')]
 * @property string $Create_priv [enum('N', 'Y')]
 * @property string $Drop_priv [enum('N', 'Y')]
 * @property string $Reload_priv [enum('N', 'Y')]
 * @property string $Shutdown_priv [enum('N', 'Y')]
 * @property string $Process_priv [enum('N', 'Y')]
 * @property string $File_priv [enum('N', 'Y')]
 * @property string $Grant_priv [enum('N', 'Y')]
 * @property string $References_priv [enum('N', 'Y')]
 * @property string $Index_priv [enum('N', 'Y')]
 * @property string $Alter_priv [enum('N', 'Y')]
 * @property string $Show_db_priv [enum('N', 'Y')]
 * @property string $Super_priv [enum('N', 'Y')]
 * @property string $Create_tmp_table_priv [enum('N', 'Y')]
 * @property string $Lock_tables_priv [enum('N', 'Y')]
 * @property string $Execute_priv [enum('N', 'Y')]
 * @property string $Repl_slave_priv [enum('N', 'Y')]
 * @property string $Repl_client_priv [enum('N', 'Y')]
 * @property string $Create_view_priv [enum('N', 'Y')]
 * @property string $Show_view_priv [enum('N', 'Y')]
 * @property string $Create_routine_priv [enum('N', 'Y')]
 * @property string $Alter_routine_priv [enum('N', 'Y')]
 * @property string $Create_user_priv [enum('N', 'Y')]
 * @property string $Event_priv [enum('N', 'Y')]
 * @property string $Create_tablespace_priv [enum('N', 'Y')]
 * @property string $ssl_type [enum('', 'ANY', 'X509', 'SPECIFIED')]
 * @property string $ssl_cipher [blob]
 * @property string $x509_issuer [blob]
 * @property string $x509_subject [blob]
 * @property int $max_questions [int(11) unsigned]
 * @property int $max_updates [int(11) unsigned]
 * @property int $max_connections [int(11) unsigned]
 * @property int $max_user_connections [int(11) unsigned]
 * @property string $plugin [char(64)]
 * @property string $authentication_string
 * @property string $password_expired [enum('N', 'Y')]
 * @property int $password_last_changed [timestamp]
 * @property int $password_lifetime [smallint(5) unsigned]
 * @property string $account_locked [enum('N', 'Y')]
 * @property array $wishListAsArray
 * @property-read Product[] $wishedProducts
 * @property string $wish_list
 * @property string $first_name [varchar(255)]
 * @property string $last_name [varchar(255)]
 * @property string $address [varchar(255)]
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const TYPE_PHONE_VERIFYING = 18;
    const STATUS_SET_INFO = 19;

    const STAFF = 2;
    const CUSTOMER = 3;


    const MARRIED = 34;
    const DONT_MARRIED = 35;

    const SCENARIO_AUTH = 'auth_scenario';
    const SCENARIO_SET_RASSROCHKA_INFO = 'rassrochka_scenario';

    public $password;

    /**
     * @var array
     */
    private $_wishListAsArray;

    //<editor-fold desc="Parent methods" defaultstate="collapsed">

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function scenarios()
    {
        $arr = parent::scenarios();
        return array_merge($arr, [
            self::SCENARIO_AUTH => ['username', 'phone', 'password', 'type'],
            self::SCENARIO_SET_RASSROCHKA_INFO => ['work', 'profession', 'passport_front', 'passport_back', 'passport_with_person', 'card_number', 'card_expiry', 'card_phone'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['family', 'experience', 'salary'], 'integer'],
            [['work', 'profession', 'passport_front', 'passport_back', 'passport_with_person', 'card_number', 'card_expiry', 'card_phone'], 'string'],
            [['work', 'profession', 'passport_front', 'passport_back', 'passport_with_person', 'card_number', 'card_expiry', 'card_phone'], 'required', 'on' => self::SCENARIO_SET_RASSROCHKA_INFO],
            [['phone', 'name', 'code', 'verify_time'], 'safe'],
            ['password', 'safe'],
            ['username', 'trim'],
            ['username', 'unique', 'message' => 'This username has already been taken.'],
            ['username', 'required'],

            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::TYPE_PHONE_VERIFYING, self::STATUS_SET_INFO, self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }


    //</editor-fold>

    //<editor-fold desc="Required methods" defaultstate="collapsed">

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findFrontUser($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE, 'type' => self::CUSTOMER]);
    }

    public static function findBackUser($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE, 'type' => self::STAFF]);
    }


    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    //</editor-fold>

    //<editor-fold desc="Wishlist" defaultstate='collapsed'>


    /**
     * @return array
     */
    public function getWishListAsArray()
    {
        if ($this->_wishListAsArray == null) {
            $wishlist = Json::decode($this->wish_list);
            if (!is_array($wishlist)) {
                $wishlist = [];
            }
            $this->setWishListAsArray($wishlist);
        }
        return $this->_wishListAsArray;
    }

    public function setWishListAsArray($wishlist = [])
    {
        $this->_wishListAsArray = $wishlist;
    }

    /**
     * @param $id int Kurs id raqami
     * @return bool
     */
    public function addToWishList($id)
    {
        $wishlist = $this->wishListAsArray;
        if (!in_array($id, $wishlist)) {
            $wishlist[] = $id;
        }
        $this->wish_list = Json::encode($wishlist);
        if ($this->save(false)) {
            $this->setWishListAsArray($wishlist);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id int Kurs id raqami
     * @return bool
     */
    public function removeFromWishList($id)
    {
        $wishlist = $this->wishListAsArray;
        $key = array_search($id, $wishlist);
        if ($key !== false) {
            unset($wishlist[$key]);
        }
        $this->wish_list = Json::encode($wishlist);
        if ($this->save(false)) {
            $this->setWishListAsArray($wishlist);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Berilgan id raqamidagi kurs Userning wishlistiga qo'shilgan bo'lsa true, aks holda false qaytaradi
     * @param $id int Kurs id raqami
     * @return bool
     */
    public function isWish($id)
    {
        return in_array($id, $this->wishListAsArray);
    }

    public function getWishedProducts()
    {
        return Product::find()->andWhere(['id' => $this->wishListAsArray])->active()->all();
    }

    //</editor-fold>

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }


    public static function lifeStatuses(): array
    {
        return [
            self::MARRIED => Yii::t('app', 'Married'),
            self::DONT_MARRIED => Yii::t('app', 'Dont Married')
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'work' => Yii::t('app', 'Work'),
            'profession' => Yii::t('app', 'Profession'),
            'card_number' => Yii::t('app', 'Card Number'),
            'card_expiry' => Yii::t('app', 'Card Expiry'),
            'card_phone' => Yii::t('app', 'Card Phone'),
            'salary' => Yii::t('app', 'Salary'),
            'passport_front' => Yii::t('app', 'Passport Front'),
            'passport_back' => Yii::t('app', 'Passport Back'),
            'passport_with_person' => Yii::t('app', 'Passport With Person'),
        ];
    }


    public function savePassportFront()
    {
        $this->passport_front->saveAs('uploads/personal' . "/passport_front_" . user('id') . '.' . $this->passport_front->extension);
        $this->passport_front = '/uploads/personal' . "/passport_front_" . user('id') . '.' . $this->passport_front->extension;
    }

    public function savePassportBack()
    {
        $this->passport_back->saveAs('uploads/personal' . "/passport_back_" . user('id') . '.' . $this->passport_back->extension);
        $this->passport_back = '/uploads/personal' . "/passport_back_" . user('id') . '.' . $this->passport_back->extension;
    }

    public function savePassportWithPerson()
    {
        $this->passport_with_person->saveAs('uploads/personal' . "/passport_with_person_" . user('id') . '.' . $this->passport_with_person->extension);
        $this->passport_with_person = '/uploads/personal' . "/passport_with_person_" . user('id') . '.' . $this->passport_with_person->extension;
    }


    public function canLoan()
    {
        return $this->first_name && $this->last_name && $this->phone && $this->work && $this->profession && $this->card_number && $this->card_expiry && $this->card_phone && $this->salary && $this->passport_front && $this->passport_back && $this->passport_with_person;
    }


    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE => Yii::t('app', 'In Active'),
            self::STATUS_DELETED => Yii::t('app', 'Deleted'),
        ];
    }
}
