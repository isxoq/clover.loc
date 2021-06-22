<?php

namespace backend\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $icon
 * @property string $title
 * @property string $content
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 */
class Service extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'service';
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['title', 'content'],
                'languages' => $this->languages(),
            ],
            TimestampBehavior::class,
        ];
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            [['title', 'content'], 'string'],
            [['icon'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['icon'], 'string', 'max' => 100],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

}
