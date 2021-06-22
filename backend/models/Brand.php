<?php

namespace backend\models;

use backend\modules\productmanager\models\Product;
use mohorev\file\UploadImageBehavior;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $img
 * @property-read mixed $imageUrl
 * @property-read Product[] $products
 * @property int|null $status
 */
class Brand extends \soft\db\ActiveRecord
{
    public static function tableName()
    {
        return 'brand';
    }

    public function rules()
    {
        return [
            [['name','img','status'],'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 150],
            ['img', 'image', 'maxSize' => 300*1024],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'img',
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/images/brands/{id}',
                'url' => '/uploads/images/brands/{id}',
                'thumbs' => [],
            ],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'img' => Yii::t('app', 'Img'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getImageUrl()
    {
        return $this->getUploadUrl('img');
    }

    public function getProducts(){
        return $this->hasMany(Product::className(),[
            'brand_id' => 'id'
        ]);
    }
}
