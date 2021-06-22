<?php

namespace backend\modules\postmanager\models;

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
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $status
 * @property string|null $image
 * @property string|null $small_image
 * @property int|null $published_at
 * @property int|null $category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $title
 * @property int|null $short_description
 * @property int|null $content
 *
 * @property PostCategory $category
 * @property User $createdBy
 * @property User $updatedBy
 * @property-read mixed $smallImage
 * @property-read mixed $publishedMonth
 * @property-read mixed $publishedDay
 * @property-read mixed $dateFormat
 * @property-read mixed $largeImage
 */
class Post extends \soft\db\ActiveRecord
{

    public $publishedAtField;

    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return
            [

                'multilingual' => [
                    'class' => MultilingualBehavior::class,
                    'attributes' => ['title', 'short_description', 'content'],
                    'languages' => $this->languages(),
                ],

                'timestamp' => [
                    'class' => TimestampBehavior::class,
                ],
                'slug' => [
                    'class' => CyrillicSlugBehavior::class,
                    'attribute' => 'title',
                ],
                'blameable' => [
                    'class' => BlameableBehavior::class,
                ],
                'image' => [
                    'class' => UploadImageBehavior::class,
                    'attribute' => 'image',
                    'deleteOriginalFile' => true,
                    'scenarios' => ['default'],
                    'path' => '@frontend/web/uploads/images/post/image/{id}',
                    'url' => '/uploads/images/post/image/{id}',
                    'thumbs' => [
                        'preview' => ['width' => 880],
                    ],
                ],
                'smallImage' => [
                    'class' => UploadImageBehavior::class,
                    'attribute' => 'small_image',
                    'deleteOriginalFile' => true,
                    'scenarios' => ['default'],
                    'path' => '@frontend/web/uploads/images/post/small_image/{id}',
                    'url' => '/uploads/images/post/small_image/{id}',
                    'thumbs' => [
                        'preview' => ['width' => 280, 'quality' => 90],
                    ],
                ],
            ];
    }

    public function rules()
    {
        return [
            [['status', 'published_at', 'category_id'], 'integer'],
            ['category_id','required'],
            [['slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['title'], 'string', 'max' => 255],
            [['title'], 'required'],

            [['image'], 'image', 'maxSize' => 1000 * 1024],
            [['small_image'], 'image', 'maxSize' => 500 * 1024],
            [['short_description', 'content'], 'string'],

            ['publishedAtField', 'safe'],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'short_description' => "Qisqa tavsif",
            'image' => "Asosiy rasm",
            'largeImage' => "Asosiy rasm",
            'small_image' => "Kichik rasm",
            'smallImage' => "Kichik rasm",
            'published_at' => "E'lon qilish sanasi",
            'category_id' => "Kategoriya",
            'category.name' => "Kategoriya",
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }


    public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id']);
    }


    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }


    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public static function find()
    {
        $query = new PostQuery(get_called_class());
        return $query->multilingual();
    }

    public function getSmallImage()
    {
        return $this->getBehavior('smallImage')->getThumbUploadUrl('small_image', 'preview');
    }

    public function getLargeImage()
    {
        return $this->getBehavior('image')->getThumbUploadUrl('image', 'preview');
    }

    public function getPublishedDay()
    {
        return Yii::$app->formatter->asDate($this->published_at, 'dd');
    }

    public function getPublishedMonth()
    {
        return Yii::t('site', date('M', $this->published_at));
    }

    public function getDateFormat()
    {
        return Yii::$app->formatter->asDate($this->published_at);

    }

}
