<?php

/* @var $this \yii\web\View */

/* @var $product \frontend\models\Product */

use yii\helpers\Url;
use backend\models\Wishlist;

$user_id = Yii::$app->user->id;
$detailUrl = $product->detailUrl;
?>

<div class="col-md-4 col-6">
    <div class="product text-center appear-animate">
        <figure class="product-media">
            <a href="<?= to(['product/detail', 'slug' => $product->slug]) ?>" class="product-image-link">
                <img src="<?= $product->getImage() ?>" alt="product"
                     width="220" height="206" style="height: 206px">
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
                <a href="<?= to(['product/detail', 'slug' => $product->slug]) ?>"
                   class="product-name-link"><?= $product->name ?></a>
            </h3>
            <div class="product-price">

                <ins class="new-price product-price-element"><?= $product->formattedPrice ?></ins>

                <?php if ($product->hasDiscount): ?>
                    <del
                            class="old-price"><?= $product->formattedOldPrice ?>
                    </del>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>