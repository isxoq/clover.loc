<?php

namespace backend\modules\usermanager\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $auth_key
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $phone
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $address
 * @property int|null $code
 * @property int|null $verify_time
 * @property string|null $wish_list
 * @property int|null $family
 * @property string|null $work
 * @property string|null $profession
 * @property int|null $experience
 * @property int|null $salary
 * @property string|null $passport_front
 * @property string|null $passport_back
 * @property string|null $passport_with_person
 * @property string|null $card_number
 * @property string|null $card_expiry
 * @property string|null $card_phone
 *
 * @property Auth[] $auths
 * @property Order[] $orders
 * @property Post[] $posts
 * @property Post[] $posts0
 * @property Town[] $towns
 * @property Town[] $towns0
 */
class User extends \soft\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }


    public function beforeSave($insert)
    {
        $this->phone = Yii::$app->help->clearPhoneNumber($this->phone);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function rules()
    {
        return [
            [['username', 'created_at', 'updated_at', 'status'], 'required'],
            [['status', 'created_at', 'updated_at', 'code', 'verify_time', 'family', 'experience', 'salary'], 'integer'],
            [['wish_list'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'phone', 'first_name', 'last_name', 'address', 'work', 'profession', 'passport_front', 'passport_back', 'passport_with_person', 'card_number', 'card_expiry', 'card_phone'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'phone' => Yii::t('app', 'Phone'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address' => Yii::t('app', 'Address'),
            'code' => Yii::t('app', 'Code'),
            'verify_time' => Yii::t('app', 'Verify Time'),
            'wish_list' => Yii::t('app', 'Wish List'),
            'family' => Yii::t('app', 'Family'),
            'work' => Yii::t('app', 'Work'),
            'profession' => Yii::t('app', 'Profession'),
            'experience' => Yii::t('app', 'Experience'),
            'salary' => Yii::t('app', 'Salary'),
            'passport_front' => Yii::t('app', 'Passport Front'),
            'passport_back' => Yii::t('app', 'Passport Back'),
            'passport_with_person' => Yii::t('app', 'Passport With Person'),
            'card_number' => Yii::t('app', 'Card Number'),
            'card_expiry' => Yii::t('app', 'Card Expiry'),
            'card_phone' => Yii::t('app', 'Card Phone'),
        ];
    }


    public function getAuths()
    {
        return $this->hasMany(Auth::className(), ['user_id' => 'id']);
    }


    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }


    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['created_by' => 'id']);
    }


    public function getPosts0()
    {
        return $this->hasMany(Post::className(), ['updated_by' => 'id']);
    }


    public function getTowns()
    {
        return $this->hasMany(Town::className(), ['created_by' => 'id']);
    }


    public function getTowns0()
    {
        return $this->hasMany(Town::className(), ['updated_by' => 'id']);
    }

}
