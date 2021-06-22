<?php

namespace backend\models;

use mohorev\file\UploadImageBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $description
 * @property string $text1
 * @property string $text2
 * @property string $urlName
 * @property int $status
 * @property string|null $url
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property-read mixed $imageUrl
 * @property-read mixed $imageRightUrl
 * @property bool $is_right [tinyint(1)]
 */
class Banner extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'banner';
    }

    public function rules()
    {
        return [
            [[ 'title'], 'required'],
            [['status', 'created_at', 'updated_at', 'is_right'], 'integer'],
            [['url','description'], 'string', 'max' => 255],
            [['title'],'string','max'=>150],
            [['text1','text2'],'string','max'=>100],
            [['urlName'],'string','max'=>30],
            [['img'],'image']
        ];
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['title','description','text1','text2','urlName'],
                'languages' => $this->languages(),
            ],
            'timestamp' => [
                'class' =>  TimestampBehavior::class,
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'deleteOriginalFile' => true,
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/images/banner/{id}',
                'url' => '/uploads/images/banner/{id}',
                'thumbs' => [
                    'preview' => ['width' => 580],
                    'right' => ['width' => 346],
                ],
            ],
        ];
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }
    public function setAttributeLabels()
    {
        return [
            'img' => Yii::t('app', 'Img'),
            'url' => Yii::t('app', 'Url'),
            'is_right' => "O'ng tarafda",
        ];
    }
    public function getImageUrl()
    {
        return $this->getThumbUploadUrl('img','preview');
    }
    public function getImageRightUrl()
    {
        return $this->getThumbUploadUrl('img','right');
    }

}
