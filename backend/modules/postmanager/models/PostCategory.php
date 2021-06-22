<?php

namespace backend\modules\postmanager\models;

use soft\behaviors\CyrillicSlugBehavior;
use soft\helpers\ArrayHelper;
use Yii;
use yii\behaviors\TimestampBehavior;
use soft\behaviors\MultilingualBehavior;

/**
 * This is the model class for table "post_category".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Post[] $posts
 * @property PostCategoryLang[] $postCategoryLangs
 */
class PostCategory extends \soft\db\ActiveRecord
{
    public $multilingualAttributes = ['name'];

    public static function tableName()
    {
        return 'post_category';
    }

    public function behaviors()
    {
        return
            [
                'multilingual' => [
                    'class' => \yeesoft\multilingual\behaviors\MultilingualBehavior::class,
                    'attributes' => ['name'],
                    'languages' => $this->languages(),
                ],
                'timestamp' => [
                    'class' => TimestampBehavior::class,
                ],
                'slug' => [
                    'class' => CyrillicSlugBehavior::class,
                    'attribute' => 'name',
                ]
            ];
    }

    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }

}
