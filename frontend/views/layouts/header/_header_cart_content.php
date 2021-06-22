<?php

use \frontend\components\Cart;
use yii\helpers\Url;

$count = Cart::totalCount();
$cartProducts = Cart::products(true);
$sum = Cart::formattedTotalSum();
$cart = Cart::cart();
$hasProducts = !empty($cartProducts);
?>


<a href="#" class="cart-toggle label-block link" id="cart-shoping">
    <i class="d-icon-bag"><span class="cart-count"><?= $count ?></span></i>
</a>
<div class="cart-overlay"></div>

<div class="dropdown-box">
    <?php if ($hasProducts): ?>
        <div class="cart-header">
            <h4 class="cart-title"><?= Yii::t('app', 'Shopping Cart') ?></h4>
        </div>
        <div class="products scrollable" style="max-height: 260px!important;">
            <?php foreach ($cartProducts as $product): ?>
                <?php
                $productQuantity = $cart[$product->id];
                ?>
                <div class="product product-cart">
                    <figure class="product-media">
                        <a href="<?= Url::to(['product/detail', 'slug' => $product->slug]) ?>">
                            <img src="<?= $product->getImage() ?>" alt="product" width="80"
                                 height="88"/>
                        </a>
                        <a href="<?= Url::to(['cart/remove', 'product_id' => $product->id, 'is_view_cart_page' => Yii::$app->controller->route == 'shop/view-cart']) ?>"
                           class="btn btn-link btn-close remove-from-cart">
                            <i class="fas fa-times"></i>
                            <span class="sr-only">
                                <?= t('Remove') ?>
                            </span>
                        </a>
                    </figure>
                    <div class="product-detail">
                        <a href="<?= Url::to(['product/detail', 'slug' => $product->slug]) ?>"
                           class="product-name"><?= $product->name ?></a>
                        <div class="price-box">
                            <span class="product-quantity" id="productQuantity"><?= $productQuantity ?></span>
                            <span class="product-price"><?= Yii::$app->formatter->asSum($product->price) ?></span>
                        </div>
                    </div>

                </div>
                <?php $productQuantity = null ?>
            <?php endforeach; ?>
            <!-- End of Cart Product -->
        </div>
        <div class="cart-total">
            <label><?= Yii::t('app', 'Subtotal') ?> : </label>
            <span class="price"><?= $sum == null ? "0.00" : $sum ?></span>
        </div>
        <div class="cart-action">

            <a href="<?= to(['shop/view-cart']) ?>"
               class="btn btn-dark"><span><?= Yii::t('app', 'View cart') ?></span></a>
        </div>
    <?php else: ?>
        <img src="/images/empty_shopping_cart.png" alt="">
        <p style="color: #666; font-weight: 600; font-size: 16px; text-align:center; line-height: 25px"><?= t('There are no products in your shopping cart') ?></p>
    <?php endif ?>
</div>


