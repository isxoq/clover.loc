<?php

namespace backend\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "faq_type".
 *
 * @property int $id
 * @property int|null $status
 * @property string|null $name
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property-read Faq[] $faqs
 */
class FaqType extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'faq_type';
    }

    public function rules()
    {
        return [
            [['name','status'],'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['name'],
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
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Yaqatilgan vaqti'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function getFaqs()
    {
        return $this->hasMany(Faq::className(), ['faq_type_id' => 'id']);
    }

}
