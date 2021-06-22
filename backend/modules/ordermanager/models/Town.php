<?php

namespace backend\modules\ordermanager\models;

use backend\modules\postmanager\models\query\PostQuery;
use common\models\User;
use mohorev\file\UploadImageBehavior;
use soft\behaviors\CyrillicSlugBehavior;
use soft\helpers\ArrayHelper;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "town".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $status
 * @property int|null $delivery_price
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Town extends \soft\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'town';
    }

    public function behaviors()
    {
        return
            [
                'multilingual' => [
                    'class' => MultilingualBehavior::class,
                    'attributes' => ['title'],
                    'languages' => $this->languages(),
                ],
                'timestamp' => [
                    'class' => TimestampBehavior::class,
                ],
                'slug' => [
                    'class' => CyrillicSlugBehavior::class,
                    'attribute' => 'title',
                ],

            ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'string'],
            [['status', 'delivery_price', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'delivery_price' => Yii::t('app', 'Delivery Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }


    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

}
