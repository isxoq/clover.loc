<?php

namespace backend\modules\productmanager\models;

use backend\models\RecommendedCategory;
use backend\modules\charactermanager\models\Character;
use backend\modules\charactermanager\models\CharacterGroup;
use backend\modules\productmanager\models\behaviors\CategoryParentIdBehavior;
use backend\modules\productmanager\models\query\CategoryQuery;
use kartik\tree\Module;
use kartik\tree\TreeView;
use mohorev\file\UploadImageBehavior;
use soft\db\ActiveQuery;
use Yii;
use kartik\tree\models\Tree;
use soft\behaviors\CyrillicSlugBehavior;
use soft\helpers\ArrayHelper;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/**
 * Class Category
 * @package backend\modules\productmanager\models
 * @property string $slug [varchar(255)]
 * @property bool $status [tinyint(1)]
 * @property bool $child_allowed [tinyint(1)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $parent_id [int(11)]
 * @property-read Category[] $activeSubCategories
 * @property-read Product[] $products
 * @property-read Product[] $activeProducts
 * @property string $title
 * @property-read Category[] $subCategories
 * @property-read mixed $imageUrl
 * @property-read Product[] $allActiveProducts
 * @property-read string $iconHtml
 * @property-read mixed $recommendedCategories
 * @property string $image [varchar(150)]
 * @method getThumbUploadUrl(string $string, string $string1)
 */
class Category extends Tree
{

    const ICON_TYPE_RIODE = 1;
    const ICON_TYPE_FA = 2;

    public static $productClassName = 'backend\modules\productmanager\models\Product';

    public static $treeQueryClass = 'soft\db\ActiveQuery';

    //<editor-fold desc="Parent" defaultstate="collapsed">

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['title'],
                'languages' => Yii::$app->params['languages'],
            ],

            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            'slug' => [
                'class' => CyrillicSlugBehavior::class,
                'attribute' => 'title',
            ],
            'parentId' => [
                'class' => CategoryParentIdBehavior::class,
            ],
            'uploadImage' => [
                'class' => UploadImageBehavior::class,
                'attribute' => 'image',
                'scenarios' => ['default'],
                'deleteOriginalFile' => true,
                'path' => '@frontend/web/uploads/images/category/{id}',
                'url' => '/uploads/images/category/{id}',
                'thumbs' => [
                    'preview' => ['width' => 190],
                ],
            ],
        ]);
    }

    public function rules()
    {
        /**
         * @var Module $module
         */
        $module = TreeView::module();
        $nameAttribute = $iconAttribute = $iconTypeAttribute = null;
        extract($module->dataStructure);
        $attributes = array_merge([$nameAttribute, $iconAttribute, $iconTypeAttribute], static::$boolAttribs);
        $rules = [
            [$attributes, 'safe'],
        ];
        if ($this->encodeNodeNames) {
            $rules[] = [
                $nameAttribute,
                'filter',
                'filter' => function ($value) {
                    return Html::encode($value, false);
                },
            ];
        }
        if ($this->purifyNodeIcons) {
            $rules[] = [
                $iconAttribute,
                'filter',
                'filter' => function ($value) {
                    return HtmlPurifier::process($value);
                },
            ];
        }

        $rules[] = ['status', 'boolean'];
        $rules[] = [['title', 'slug'], 'string', 'max' => 255];
        $rules[] = ['title', 'required'];
        $rules[] = ['title', 'trim'];
        $rules[] = ['image', 'image'];
        $rules[] = ['parent_id', 'integer'];

        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'title' => "Kategoriya nomi",
            'title_uz' => "Kategoriya nomi [O'zbek]",
            'title_ru' => "Kategoriya nomi [Русский]",
            'image' => Yii::t('app', 'Image')
        ];
    }

    public static function find()
    {
        $query = new CategoryQuery(get_called_class());
        return $query->multilingual()->addOrderBy('root, lft');
    }

    //</editor-fold>

    //<editor-fold desc="Categories" defaultstate="collapsed">

    /**
     * Query to find main categories
     * @return ActiveQuery
     */
    public static function findMainCategories()
    {
        return static::find()
            ->where(['root' => 1, 'lvl' => 1, 'disabled' => 0, 'active' => 1]);
    }

    /**
     * All active main categories (as list of objects)
     * Ushbu ro'yxat frontendga categoriyalarni chiqarish uchun ishlatiladi
     * @return static[]
     */
    public static function activeMainCategories($withSubCategories = false)
    {
        return Yii::$app->db->cache(function () use ($withSubCategories) {

            $query = static::findMainCategories()
                ->andWhere(['status' => 1]);
            if ($withSubCategories) {
                $query->with('activeSubCategories');
            }
            return $query->all();
        });
    }

    public function getSubCategories()
    {
        return $this->hasMany(static::class, ['parent_id' => 'id'])
            ->andWhere(['disabled' => 0, 'active' => 1]);
    }

    /**
     * Bitta categoriyaga tegishli ichki faol kategoriyalar ro'yxati
     * @return \yii\db\ActiveRecord
     */
    public function getActiveSubCategories()
    {
        return $this->getSubCategories()
            ->andWhere(['status' => 1]);
    }

    //</editor-fold>

    //<editor-fold desc="Products" defaultstate="collapsed">

    /**
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(static::$productClassName, ['category_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getActiveProducts()
    {
        return $this->getProducts()->active();
    }

    /**
     * Query to get AllActiveProducts
     * @return \soft\db\ActiveQuery
     */
    public function findAllActiveProducts()
    {
        $categoryIds = ArrayHelper::getColumn($this->getActiveSubCategories()->asArray()->all(), 'id');
        $categoryIds[] = $this->id;
        $productClassname = static::$productClassName;
        return $productClassname::find()->andWhere(['category_id' => $categoryIds]);

    }

    /**
     * Kategoriya va uning ichidagi sub kategoriyalarga tergishli productlar
     * @return \backend\modules\productmanager\models\Product|\frontend\models\Product[]
     */
    public function getAllActiveProducts()
    {
        return $this->findAllActiveProducts()->all();
    }

    /**
     * Kategoriya va uning ichidagi sub kategoriyalarga tegishli aktiv tovarlardan $limit sondagisini random ajratib beradi
     * @param int $limit
     * @return \backend\modules\productmanager\models\Product[]|\frontend\models\Product[]
     */
    public function randomActiveProducts($limit = 6)
    {
        return $this->findAllActiveProducts()
            ->with('galleryImagesAsArray')
            ->orderBy(new Expression('rand()'))
            ->limit($limit)
            ->all();
    }


    //</editor-fold>

    public static function iconTypes()
    {
        return [
            self::ICON_TYPE_RIODE => 'Riode Icons',
            self::ICON_TYPE_FA => 'Font Awesome',
        ];
    }

    public function getIconHtml()
    {
        if (empty($this->icon)) {
            return '';
        }
        if ($this->icon_type == self::ICON_TYPE_RIODE) {
            return "<i class='$this->icon'></i>";
        }
        if ($this->icon_type == self::ICON_TYPE_FA) {
            return "<i class='fas fa-$this->icon'></i>";
        }
        return '';
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->getThumbUploadUrl('image', 'preview');
    }

    public function getRecommendedCategories()
    {

        return $this->hasMany(RecommendedCategory::className(), [
            'category_id' => 'id'
        ]);
    }


    public function getAttributeValues()
    {
        $lang = Yii::$app->language;
        return $this->hasMany(ProductCharacterAssign::className(), ['product_id' => 'id'])->via('activeProducts');
    }

    public function getAttributesNames()
    {
        return $this->hasMany(Character::className(), ['id' => 'character_id'])->via('attributeValues');
    }

    public function getAttributeGroups()
    {
        return $this->hasMany(CharacterGroup::class, ['id' => 'group_id'])->via('attributesNames');
    }

}