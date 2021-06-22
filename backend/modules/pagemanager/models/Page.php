<?php

namespace backend\modules\pagemanager\models;

use mohorev\file\UploadImageBehavior;
use soft\behaviors\CyrillicSlugBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $image
 * @property int|null $status
 * @property string|null $title
 * @property string|null $short_description
 * @property string|null $content
 *
 */
class Page extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['title', 'short_description', 'content'],
                'languages' => $this->languages(),
            ],
            TimestampBehavior::class,
            [
                'class' => CyrillicSlugBehavior::class,
                'attribute' => 'title',
            ],
            'image' => [
                'class' => UploadImageBehavior::class,
                'attribute' => 'image',
                'deleteOriginalFile' => true,
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/images/page/{id}',
                'url' => '/uploads/images/page/{id}',
                'thumbs' => [
                    'preview' => ['width' => 880],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [

            ['title', 'string', 'max' => 255],
            ['title', 'required'],
            [['short_description', 'content'], 'string'],
            [['status'], 'integer'],
            [['slug', 'image'], 'string', 'max' => 255],
        ];
    }

    public function setAttributeLabels()
    {
        return [
        ];
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }

    public function getImage()
    {
        return $this->getThumbUploadUrl('image', 'preview');
    }

}
