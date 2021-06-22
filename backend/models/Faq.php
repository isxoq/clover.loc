<?php

namespace backend\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property int $status
 * @property int $faq_type_id
 * @property int|null $created_at
 * @property-read \backend\models\FaqType $faqType
 * @property int|null $updated_at
 */
class Faq extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'faq';
    }

    public function rules()
    {
        return [
            [['status', 'faq_type_id', 'question', 'asked'], 'required'],
            [['status', 'faq_type_id', 'created_at', 'updated_at'], 'integer'],
            [['question', 'asked'], 'string'],
        ];
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['question', 'asked'],
                'languages' => $this->languages(),
            ],
            TimestampBehavior::class,
        ];
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'faq_type_id' => Yii::t('app', 'Faq Type'),
            'question' => Yii::t('app', 'Savol'),
            'asked' => Yii::t('app', 'Javob'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getFaqType()
    {
        return $this->hasOne(FaqType::className(), ['id' => 'faq_type_id']);
    }

}
