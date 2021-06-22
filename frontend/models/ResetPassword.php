<?php

namespace frontend\models;
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/17/2021
 * Time: 10:01 AM
 * Project name: shop
 */

use common\models\User;
use yii;

class ResetPassword extends \yii\base\Model
{
    public $phone;
    public $code;
    public $password;
    public $password_repeat;

    const SCENARIO_PHONE = 'phone';
    const SCENARIO_CHANGE = 'change';
    const SCENARIO_VERIFY = 'phone_verify';

    public function scenarios(): array
    {
        return [

            self::SCENARIO_PHONE => ['phone'],
            self::SCENARIO_VERIFY => ['phone', 'code'],
            self::SCENARIO_CHANGE => ['password', 'password_repeat']

        ];
    }

    public function rules(): array
    {
        return [

            ['code', 'string'],
            [['phone', 'password', 'code', 'password_repeat'], 'required'],
            ['phone', 'string'],
            ['phone', 'hasPhone'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => t("Passwords don't match")],

        ];
    }

    public function hasPhone()
    {
        $user = \common\models\User::find()->andWhere(['username' => Yii::$app->help->clearPhoneNumber($this->phone)])->one();
        if (!$user) {
            $this->addError('phone', Yii::t('app', 'Telefon topilmadi'));
        }

    }

    public function saveToSession()
    {
        Yii::$app->session->set('tempResetPhone', Yii::$app->help->clearPhoneNumber($this->phone));
    }

    public function clearSession()
    {

        return Yii::$app->session->remove('tempResetPhone');
    }

    public function getTempPhone()
    {
        return Yii::$app->session->get('tempResetPhone');
    }

    /**
     * @return bool
     */
    public function isExpired()
    {

        $user = User::findOne(['phone' => $this->getTempPhone()]);
        if ($user) {
            if ($user->verify_time > intval(date('U'))) {
                $this->addError('code', Yii::t('app', 'Verify Code Expired'));
                return false;
            }
            return true;
        }
        return false;

    }

    public function validateVerificationCode()
    {
        $user = User::findOne(['phone' => $this->getTempPhone()]);
        if (!$this->isExpired()) {
            if ($this->code == $user->code) {

//                $user->status = User::STATUS_SET_INFO;
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
        $user = User::findOne(['phone' => $this->getTempPhone(), 'status' => User::STATUS_ACTIVE]);

        $user->code = "";
        $user->verify_time = null;
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
            if ($user->status == User::STATUS_ACTIVE) {
                $this->addError('phone', Yii::t('app', 'Telefon band qilingan'));
            }
        }
    }

    public function generateVerifyCode()
    {
        $user = User::find()->andWhere(['username' => $this->getTempPhone()])->one();
        $user->verify_time = time() + 120;
        $user->code = random_int(Yii::$app->params['user.minCodeLength'], Yii::$app->params['user.maxCodeLength']);
        $user->save();
    }


}

?>