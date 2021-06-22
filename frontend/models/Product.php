<?php

namespace frontend\models;

use Yii;
use soft\helpers\Html;
use soft\helpers\Url;

/**
 *
 * @property-read \frontend\models\Category $category
 * @property-read string $wishlistButton
 * @property-read mixed $stockStatus
 * @property-read string $addToCartButton
 * @property-read string $quickViewButton
 * @property-read mixed $detailUrl
 */
class Product extends \backend\modules\productmanager\models\Product
{

    public function rules()
    {
        return [];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['timestamp']);
        unset($behaviors['slug']);
        return $behaviors;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getDetailUrl()
    {
        return Url::to(['product/detail', 'slug' => $this->slug]);
    }

    public function relatedProducts($limit = 4)
    {
        return Product::find()->random($limit)->andWhere(['category_id' => $this->category_id])->notId($this->id)->all();
    }

    public function getIsWished()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        return in_array($this->id, Yii::$app->user->identity->wishlistAsArray);
    }

    /**
     * @return string wish list button
     */
    public function getWishlistButton()
    {
        if (is_guest()) {
            return '';
        }

        $icon = $this->isWished ? '<i class="d-icon-heart-full"></i>' : '<i class="d-icon-heart"></i>';
        return Html::a($icon, ['wish/add-to-wishlist', 'product_id' => $this->id], ['class' => 'btn-product-icon add-to-wishlist-btn', 'title' => t('Add to wishlist')]);
    }

    /**
     * Generates addToCartButton for product card
     * @return string
     */
    public function getAddToCartButton()
    {
        return Html::a('<i class="d-icon-bag"></i>', ['cart/add', 'product_id' => $this->id], [
            'class' => 'btn-product-icon add-to-cart-btn',
            'title' => t('Add to cart')
        ]);
    }

    /**
     * Generates quickViewButton for product card
     * @return string
     */
    public function getQuickViewButton()
    {
        $label = t('Quick view');
        return Html::a($label, $this->detailUrl, [
            'class' => 'btn-product product-quickview',
            'title' => $label
        ]);
    }

    public function getStockStatus()
    {
        return Yii::t('app', 'In stock'); //todo stock status
//         Yii::t('app','Not in stock')
    }


}