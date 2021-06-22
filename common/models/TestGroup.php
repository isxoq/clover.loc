<?php

namespace common\models;

use backend\modules\edu\models\Tutor;
use soft\helpers\ArrayHelper;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "test_group".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Tutor $createdBy
 * @property Tutor $updatedBy
 */
class TestGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'test_group';
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
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Tutor::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Tutor::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
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

    public function getQuestions()
    {
        return $this->hasMany(Question::class, ['test_group_id'=>'id']);
    }
    public function getQuestionsCount()
    {
        return $this->hasMany(Question::class, ['test_group_id'=>'id'])->count();
    }
}
