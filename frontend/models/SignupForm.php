<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use function GuzzleHttp\Psr7\str;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $phone;
    public $first_name;
    public $last_name;
    public $code;
    public $password;
    public $password_repeat;

    const SCENARIO_REGISTER = 'register';
    const SCENARIO_VERIFY = 'verify';
    const SCENARIO_ENTER_INFO = 'enterInfo';


    /**
     * @return \string[][]
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_VERIFY => ['phones', 'code'],
            self::SCENARIO_REGISTER => ['phone'],
            self::SCENARIO_ENTER_INFO => ['name','first_name','last_name', 'password', 'password_repeat']
        ];
    }


    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [

            ['phone', 'trim'],
            ['phone', 'required'],
            ['code', 'required'],
            ['phone', 'uniquePhone'],
            ['phone', 'string', 'min' => 2, 'max' => 255],
            [['first_name', 'last_name'], 'string'],
            [['password', 'first_name', 'last_name', 'password_repeat'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => t("Passwords don't match")],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

    public function attributeLabels()
    {
        return [
            'name' => t('Name')
        ];
    }

    public function signup()
    {

        if (!$this->validate()) {
            return false;
        }

        $user = User::findOne(['phone' => Yii::$app->help->clearPhoneNumber($this->phone)]);

        if (!$user) {
            $user = new User();
        }
        $user->scenario = User::SCENARIO_AUTH;
        $user->type = User::CUSTOMER;
        $user->username = Yii::$app->help->clearPhoneNumber($this->phone);
        $user->phone = Yii::$app->help->clearPhoneNumber($this->phone);
        $user->verify_time = strtotime('+ 2 minute');
        $user->status = User::TYPE_PHONE_VERIFYING;
        $user->code = random_int(Yii::$app->params['user.minCodeLength'], Yii::$app->params['user.maxCodeLength']);

        $this->saveToSession();
//        dd($user);
        return $user->save();

    }

    public function saveToSession()
    {
        Yii::$app->session->set('tempPhone', Yii::$app->help->clearPhoneNumber($this->phone));
    }

    public function clearSession()
    {

        return Yii::$app->session->remove('tempPhone');
    }

    public function getTempPhone()
    {
        return Yii::$app->session->get('tempPhone');
    }

    /**
     * @return bool
     */
    public function isNotExpired()
    {

        $user = User::findOne(['phone' => $this->getTempPhone(), 'status' => User::TYPE_PHONE_VERIFYING]);

        if ($user) {

            if ($user->verify_time > date('U')) {
                return true;
            } else {
                $this->addError('code', Yii::t('app', 'Verify Code Expired'));
                return false;
            }
        } else {
            false;
        }


    }

    public function validateVerificationCode()
    {
        $user = User::findOne(['phone' => $this->getTempPhone(), 'status' => User::TYPE_PHONE_VERIFYING]);
        if ($this->isNotExpired()) {
            if ($this->code == $user->code) {

                $user->status = User::STATUS_SET_INFO;
                $user->save(false);

                return true;
            } else {
                $this->addError('code', Yii::t('app', 'Code Error'));
                return false;
            }
        }
    }


    public function endRegister()
    {
        $user = User::findOne(['phone' => $this->getTempPhone(), 'status' => User::STATUS_SET_INFO]);

        $user->status = User::STATUS_ACTIVE;
        $user->code = "";
        $user->verify_time = null;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $this->clearSession();
        if ($user->save() && Yii::$app->user->login($user, 3600 * 24 * 30)) {
            return true;
        }
        return false;
    }


    private function getUserModel()
    {
        return User::findOne(['phone' => $this->getTempPhone(), 'status' => User::TYPE_PHONE_VERIFYING]);

    }

    public function uniquePhone()
    {
        $user = User::findOne([
            'phone' => Yii::$app->help->clearPhoneNumber($this->phone)
        ]);


        if ($user) {
            if ($user->status != User::TYPE_PHONE_VERIFYING && $user->status != User::STATUS_SET_INFO) {
                $this->addError('phone', Yii::t('app', 'Telefon band qilingan'));
            }
        }
    }


}
