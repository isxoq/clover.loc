<?php

namespace common\models;

use backend\modules\edu\models\Tutor;
use soft\helpers\ArrayHelper;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "variant".
 *
 * @property int $id
 * @property int $question_id
 * @property string $content
 * @property int|null $isAnswer
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Tutor $createdBy
 * @property Tutor $updatedBy
 */
class Variant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'variant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['question_id', 'content'], 'required'],
            [['question_id', 'isAnswer', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Tutor::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Tutor::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'value' => \Yii::$app->user->identity->owner_id
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'question_id' => 'Savoli',
            'content' => 'variant',
            'isAnswer' => 'Javob',
            'created_at' => 'Yaratilgan',
            'updated_at' => "Tahrirlangan",
            'created_by' => 'Yaratdi',
            'updated_by' => "Tahrirladi",
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Tutor::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Tutor::className(), ['id' => 'updated_by']);
    }
}
