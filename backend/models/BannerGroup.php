<?php

namespace backend\models;

use mohorev\file\UploadImageBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "banner_group".
 *
 * @property int $id
 * @property string $img
 * @property string|null $button_url1
 * @property string|null $button_label1
 * @property string|null $button_label2
 * @property string|null $title
 * @property string|null $content
 * @property string|null $button_url2
 * @property int $status
 * @property int|null $created_at
 * @property-read mixed $imageUrl
 * @property int|null $updated_at
 *
 */
class BannerGroup extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'banner_group';
    }

    public function rules()
    {
        return [
            [['status', 'title', 'img'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['button_url1', 'button_url2', 'content'], 'string', 'max' => 255],
            [['button_label1', 'button_label2'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 150],
            [['img'], 'image']
        ];
    }

    public function behaviors()
    {

        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['title', 'content', 'button_label1', 'button_label2'],
                'languages' => $this->languages(),
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'deleteOriginalFile' => true,
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/images/bannergroup/{id}',
                'url' => '/uploads/images/bannergroup/{id}',
                'thumbs' => [
                    'preview' => ['width' => 580],
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
            'button_url1' => Yii::t('app', 'Button Url1'),
            'button_url2' => Yii::t('app', 'Button Url2'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getImageUrl()
    {
        return $this->getThumbUploadUrl('img', 'preview');
    }

}
