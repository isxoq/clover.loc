<?php
/*
 * @author Shukurullo Odilov
 * @date 17.05.2021, 10:38
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

class PersonalDataForm extends Model
{

    public $first_name;
    public $last_name;
    public $address;
    public $email;
    public $current_password;
    public $new_password;
    public $repeat_new_password;

    public function rules()
    {
        return [

            ['first_name', 'required'],

            [['first_name', 'last_name', 'address', 'email', 'current_password'], 'string', 'max' => 255],
            ['email', 'email'],

            ['current_password', 'checkCurrentPassword'],

            ['new_password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['repeat_new_password', 'compare', 'compareAttribute' => 'new_password', 'message' => t("The re-entered password does not match")],

            [['repeat_new_password'], 'required', 'message' => t('This field is required.'), 'when' => function ($model) {
                return $model->new_password != '';
            }, 'whenClient' => "function (attribute, value) {
                     return $('#personaldataform-new_password').val() != '';
                 }"],


        ];
    }

    public function checkCurrentPassword()
    {
        if (!Yii::$app->security->validatePassword($this->current_password, Yii::$app->user->identity->password_hash)) {
            $this->addError('current_password', t('Current password does not match'));
            return false;
        }
        return true;
    }

    public function attributeLabels()
    {
        return [

            'first_name' => t('Your firstname'),
            'last_name' => t('Your lastname'),
            'address' => t('Your address'),
            'current_password' => t('Current password'),
            'new_password' => t('New password'),
            'repeat_new_password' => t('Repeat new password'),
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = Yii::$app->user->identity;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->address = $this->address;

        if (!empty($this->new_password)) {
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);
        }

        return $user->save();

    }


}