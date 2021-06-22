<?php

namespace backend\modules\productmanager\models;

use backend\models\Brand;
use backend\models\GalleryImage;
use backend\models\Wishlist;
use backend\modules\charactermanager\models\Character;
use backend\modules\charactermanager\models\CharacterGroup;
use soft\behaviors\CyrillicSlugBehavior;
use soft\helpers\ArrayHelper;
use Yii;
use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $description
 * @property string|null $short_description
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keyword
 * @property int|null $price
 * @property int|null $old_price
 * @property int|null $order_count
 * @property int|null $status
 * @property int|null $created_at
 * @property-read ProductCharacterAssign[] $characterAssigns
 * @property-read CharacterGroup[] $characterGroups
 * @property-read Character[] $characters
 * @property-read int $charactersCount
 * @property int|null $updated_at
 * @property int $category_id [int(11)]
 * @property-read GalleryImage[] $galleryImages
 * @property-read Wishlist[] $wishlists
 * @property-read Brand $brand
 * @property-read Category $category
 * @property-read array $galleryImagesAsArray
 * @property-read bool $isWished
 * @property-read Wishlist[] $userWishListsAsArray
 * @property-read Wishlist[] $userWishLists
 * @property-read Character[] $activeCharacters
 * @property-read CharacterGroup[] $activeCharacterGroups
 * @property-read ProductCharacterAssign[] $activeCharacterAssigns
 * @property-read mixed $formattedOldPrice
 * @property-read mixed $formattedPrice
 * @property-read bool $hasDiscount
 * @property int $brand_id [int(11)]
 *
 */
class Product extends \soft\db\ActiveRecord
{


    //<editor-fold desc="Parent" defaultstate="collapsed">

    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            [['name', 'meta_title', 'meta_keyword'], 'string', 'max' => 255],
            [['description', 'short_description', 'meta_description',], 'string'],
            [['price', 'old_price', 'loan_price', 'order_count', 'status', 'created_at', 'updated_at', 'category_id', 'brand_id'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return
            [
                'multilingual' => [
                    'class' => \yeesoft\multilingual\behaviors\MultilingualBehavior::class,
                    'attributes' => ['name', 'short_description', 'description', 'meta_title', 'meta_description', 'meta_keyword'],
                    'languages' => $this->languages(),
                ],
                'galleryBehavior' =>
                    [
                        'class' => GalleryBehavior::class,
                        'type' => 'product',
                        'extension' => 'jpg',
                        'directory' => Yii::getAlias('@frontend/web/uploads') . '/images/product',
                        'url' => '/uploads/images/product',
                        'versions' => [
                            'original' => function ($img) {
                                /** @var \Imagine\Image\ImageInterface $img */
                                $dstSize = $img->getSize();
                                $maxWidth = 800;
//                                if ($dstSize->getWidth() > $maxWidth) {
                                $dstSize = $dstSize->widen($maxWidth);
//                                }
                                return $img
                                    ->copy()
                                    ->resize($dstSize);
                            },
                        ]
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

    public function setAttributeLabels()
    {
        return [
            'short_description' => 'Qisqa tavsif',
            'price' => 'Narxi',
            'old_price' => 'Eski narxi',
            'loan_price' => 'Rassrochka narxi',
            'order_count' => 'Buyurtmalar soni',
            'brand_id' => 'Brand nomi',
        ];
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public static function find()
    {
        return parent::find()->multilingual();
    }

    //</editor-fold>

    //<editor-fold desc="Characters" defaultstate="collapsed">

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getCharacterAssigns()
    {
        return $this->hasMany(ProductCharacterAssign::class, ['product_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getCharactersCount()
    {
        return intval($this->getCharacterAssigns()->count());
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::class, ['id' => 'character_id'])->via('characterAssigns');
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getCharacterGroups()
    {
        return $this->hasMany(CharacterGroup::class, ['id' => 'group_id'])->via('characters');
    }

    //</editor-fold>

    //<editor-fold desc="Active Characters" defaultstate="collapsed">
    /**
     * @return \soft\db\ActiveQuery
     */
    public function getActiveCharacterAssigns()
    {
        return $this->getCharacterAssigns()->active();
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getActiveCharacters()
    {
        return $this->hasMany(Character::class, ['id' => 'character_id'])
            ->via('activeCharacterAssigns')
            ->active();
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getActiveCharacterGroups()
    {
        return $this->hasMany(CharacterGroup::class, ['id' => 'group_id'])
            ->via('activeCharacters')
            ->active();
    }

//</editor-fold>

    //<editor-fold desc="Images" defaultstate="collapsed">

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getGalleryImages()
    {
        return $this->hasMany(GalleryImage::class, ['ownerId' => 'id'])
            ->andWhere(['type' => 'product'])
            ->orderBy('rank ASC');
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getGalleryImagesAsArray()
    {
        return $this->getGalleryImages()->asArray();
    }

    /**
     * All images of the product
     * @return array
     */
    public function getImages($type = 'preview')
    {
        $images = $this->galleryImagesAsArray;
        $result = [];
        foreach ($images as $image) {
            $result[] = "/uploads/images/product/$this->id/" . $image['id'] . "/$type.jpg";
        }
        return $result;

    }

    /**
     * Main image of the product
     * @return string
     */
    public function getImage($type = 'preview')
    {
        $images = $this->getImages($type);
        if (empty($images)) {
            return "/images/no-image-png";
        }
        return $images[0];
    }

    //</editor-fold>

    //<editor-fold desc="Relations" defaultstate="collapsed">

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    


    //</editor-fold>

    //<editor-fold desc="Price" defaultstate="collapsed">

    /**
     * @return bool
     */
    public function getHasDiscount()
    {
        return $this->old_price > $this->price;
    }

    /**
     * @return mixed
     */
    public function getFormattedPrice()
    {
        return Yii::$app->formatter->asSum($this->price);
    }

    /**
     * @return mixed
     */
    public function getFormattedOldPrice()
    {
        return Yii::$app->formatter->asSum($this->old_price);
    }

    //</editor-fold>
}
