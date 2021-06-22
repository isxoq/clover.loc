<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */

namespace backend\models;

use frontend\models\Category;
use mohorev\file\UploadImageBehavior;
use soft\helpers\ArrayHelper;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "recommended_category".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $image
 * @property string|null $text1
 * @property string|null $text2
 * @property string|null $text3
 * @property string|null $button_label
 * @property string|null $url
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property-read mixed $category
 * @property-read mixed $imageUrl
 */
class RecommendedCategory extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'recommended_category';
    }

    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['url', 'text1', 'text2', 'text3', 'button_label'], 'string', 'max' => 255],
            [['image'], 'image'],
        ];
    }

    public function behaviors()
    {

        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['text1', 'text2', 'text3', 'button_label'],
                'languages' => $this->languages(),
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'image',
                'deleteOriginalFile' => true,
                'scenarios' => ['default'],
                'path' => '@frontend/web/uploads/images/recommendedcategory/{id}',
                'url' => '/uploads/images/recommendedcategory/{id}',
                'thumbs' => [
                    'preview' => ['width' => 258, 'quality' => 90],
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
            'category_id' => Yii::t('app', 'Kategoriya turi'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getImageUrl()
    {
        return $this->getThumbUploadUrl('image', 'preview');
    }

    public function getCategory()
    {

        return $this->hasOne(Category::className(), [
            'id' => 'category_id'
        ]);
    }
}
