<?php

use frontend\components\Cart;
use yii\helpers\Url;

$cartProducts = Cart::products();
$count = Cart::totalCount();
$cart = Cart::cart();
$sum = Cart::formattedTotalSum();
?>
<div class="row">
    <?php if ($count == 0) { ?>
        <div class="alert alert-light alert-danger alert-icon alert-inline mb-4">
            <i class="fas fa-exclamation-triangle"></i>
            <?= Yii::t('app', 'There are no products in your shopping cart') ?>
            <button type="button" class="btn btn-link btn-close">
                <i class="d-icon-times"></i>
            </button>
        </div>
        <aside class="col-lg-4 sticky-sidebar-wrapper">
            <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                <div class="summary mb-4">
                    <h3 class="summary-title text-left"><?= Yii::t('app', 'Home') ?></h3>
                    <a href="<?= Url::to(['/']) ?>"
                       class="btn btn-dark btn-rounded btn-checkout"><?= Yii::t('app', 'Home') ?></a>
                </div>
            </div>
        </aside>
    <?php } else { ?>
        <div class="col-lg-8 col-md-12 pr-lg-4">
            <table class="shop-table cart-table">
                <thead>
                <tr>
                    <th>№</th>
                    <th><span><?= Yii::t('app', 'Product') ?></span></th>
                    <th><?= Yii::t('app', 'Name') ?></th>
                    <th><span><?= Yii::t('app', 'Price') ?></span></th>
                    <th><span><?= Yii::t('app', 'Quantity') ?></span></th>
                    <th><?= Yii::t('app', 'Subtotal') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cartProducts as $key => $cartProduct): ?>
                    <?php
                    $productQuantity = $cart[$cartProduct->id];
                    $detailUrl = $cartProduct->detailUrl;
                    ?>
                    <tr>
                        <td><?= $key + 1 ?>.</td>
                        <td class="product-thumbnail">
                            <figure>
                                <a href="<?= $detailUrl ?>">
                                    <img src="<?= $cartProduct->getImage() ?>" width="100" height="100"
                                         alt="product">
                                </a>
                            </figure>
                        </td>
                        <td class="product-name">
                            <div class="product-name-section">
                                <a href="<?= $detailUrl ?>"><?= $cartProduct->name ?></a>
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="amount"><?= $cartProduct->formattedPrice ?></span>
                        </td>
                        <td class="product-quantity">
                            <div class="input-group">
                                <button class="quantity-minus d-icon-minus minus-from-cart"
                                        data-url="<?= Url::to(['cart/minus', 'product_id' => $cartProduct->id]) ?>"></button>
                                <input class="custom-quantity form-control" type="number" min="1"
                                       value="<?= $productQuantity ?>"
                                       max="1000000" readonly>
                                <button class="quantity-plus d-icon-plus plus-to-cart"
                                        data-url="<?= to(['cart/plus', 'product_id' => $cartProduct->id]) ?>"
                                        value="<?= $cartProduct->id ?>"></button>
                            </div>
                        </td>
                        <td class="product-price">
                            <span class="amount"><?= Yii::$app->formatter->asSum(($productQuantity * $cartProduct->price)) ?></span>
                        </td>
                        <td class="product-close">
                            <a href="<?= Url::to(['cart/remove', 'product_id' => $cartProduct->id, 'is_view_cart_page' => true]) ?>"
                               class="product-remove remove-from-cart" title="Remove this product">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-actions mb-6 pt-4">
                <a href="<?= Yii::$app->request->referrer ?? to(['site/index']) ?>"
                   class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4">
                    <i class="d-icon-arrow-left"></i>
                    <?= t('Continue shopping') ?>
                </a>
            </div>

        </div>
    <?php } ?>
    <aside class="col-lg-4 sticky-sidebar-wrapper">
        <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
            <div class="summary mb-4">
                <h3 class="summary-title text-left"><?= Yii::t('app', 'Cart totlas') ?></h3>
                <?php if ($count != 0): ?>
                    <table class="total">
                        <tr class="summary-subtotal">
                            <td>
                                <h4 class="summary-subtitle"><?= Yii::t('app', 'Total price') ?> : </h4>
                            </td>
                            <td>
                                <p class="summary-total-price ls-s"><?= $sum ?></p>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <a href="<?= to(['shop/checkout']) ?>"
                   class="btn btn-dark btn-rounded btn-checkout"><?= t('Proceed to checkout') ?></a>
            </div>
        </div>
    </aside>
</div>