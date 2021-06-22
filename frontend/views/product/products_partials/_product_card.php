<?php

/* @var $this \yii\web\View */

/* @var $product \frontend\models\Product */

use yii\helpers\Url;
use backend\models\Wishlist;

$user_id = Yii::$app->user->id;
?>

<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="<?= to(['product/detail', 'slug' => $product->slug]) ?>"
               style="display: inline; width: 220px; height: 206px">
                <img src="<?= $product->getImage() ?>" alt="product"
                     width="220"
                     height="206" style="width: 380px;height: 250px;object-fit:cover">
            </a>
            <div class="product-action-vertical">
                <?= $product->addToCartButton ?>
                <?= $product->wishlistButton ?>
            </div>
            <div class="product-action">
                <?= $product->quickViewButton ?>
            </div>
        </figure>
        <div class="product-details">
            <h3 class="product-name">
                <a href="<?= to(['product/detail', 'slug' => $product->slug]) ?>"><?= e($product->name) ?></a>
            </h3>
            <div class="product-price">
                <ins class="new-price"><?= Yii::$app->formatter->asSum($product->price) ?></ins>
                <del class="old-price"><?= Yii::$app->formatter->asSum($product->old_price) ?></del>
            </div>
            <div class="product-price">
                <ins class="new-price"><?= t('v Rassrochku') ?> <?= Yii::$app->formatter->asSum($product->loan_price) ?></ins>
            </div>
        </div>
    </div>
</div>
