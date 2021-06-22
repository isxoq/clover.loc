<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $profession
 *
 * @property User $user
 */
class Admin extends \soft\db\ActiveRecord
{
    public static function tableName()
    {
        return 'admin';
    }

    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['first_name', 'last_name', 'phone', 'profession'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'phone' => Yii::t('app', 'Phone'),
            'profession' => Yii::t('app', 'Profession'),
        ];
    }

    public function setAttributeNames()
    {
        return [
            //  'multilingualAttributes' => [],
            //  'createdByAttribute' =>  'user_id',
            //  'updatedByAttribute' =>  false,
            //  'createdAtAttribute' =>  'created_at',
            //  'updatedAtAttribute' => 'updated_at',
            //  'invalidateCacheTags' => false,
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public static function find()
    {
        $query = new \soft\db\ActiveQuery(get_called_class());
        return $query;
    }
}
