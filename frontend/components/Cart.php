<?php

namespace frontend\components;

use frontend\models\Product;
use soft\helpers\ArrayHelper;
use Yii;

class Cart
{

    /**
     * @param $product_id
     * @param int $quantity
     */
    public static function add($product_id, $quantity = 1)
    {
        $session = Yii::$app->session;
        if (!$session->has('cart')) {
            $session->set('cart', []);
        }
        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] + $quantity;
        }
    }

    /**
     * @param $product_id
     */
    public static function minus($product_id)
    {

        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
            if ($_SESSION['cart'][$product_id] > 1) {
                $_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] - 1;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }


    public static function remove($product_id)
    {
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    /**
     * @return array
     */
    public static function cart()
    {
        return Yii::$app->session->get('cart', []);
    }

    /**
     * @param $product_id
     * @return int
     */
    public static function productCount($product_id)
    {
        return ArrayHelper::getValue(self::cart(), $product_id, 0);
    }

    /**
     * @param bool $withImages
     * @return Product[]
     */
    public static function products($withImages = false)
    {

        $cart = static::cart();
        $ids = array_keys($cart);
        $query = Product::find()->andWhere(['in', 'id', $ids]);
        if ($withImages) {
            $query->with('galleryImagesAsArray');
        }
        return Yii::$app->db->cache(function () use ($query) {
            return $query->all();
        }, 5);
    }

    /**
     * @return int|mixed
     */
    public static function totalCount()
    {
        $i = 0;
        $products = static::cart();
        foreach ($products as $product) {
            $i = $i + $product;
        }
        return $i;
    }

    /**
     * @return float|int
     */
    public static function totalSum()
    {
        $products = static::products();
        $sum = 0;
        foreach ($products as $product) {
            $sum += ($product->price * $_SESSION['cart'][$product->id]);
        }
        return $sum;
    }

    /**
     * @return string
     */
    public static function formattedTotalSum()
    {
        return Yii::$app->formatter->asSum(self::totalSum());
    }

    public static function clear()
    {
        return Yii::$app->session->remove('cart');
    }


}