<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $title
 * @property string|null $text
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $status
 * @property int|null $created_at
 */
class Contact extends \soft\db\ActiveRecord
{
    public static function tableName()
    {
        return 'contact';
    }

    public function rules()
    {
        return [
            [['text'], 'string'],
            [['status', 'created_at'], 'integer'],
            [['name', 'title', 'phone', 'email'], 'string', 'max' => 255],
            [['name', 'text'], 'required'],
            ['email', 'email'],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'text' => 'Text',
            'phone' => 'Phone',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => Yii::t('app', 'Date'),
        ];
    }

}
