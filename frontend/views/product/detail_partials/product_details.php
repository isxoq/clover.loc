<?php
/**
 * @author Ulug'bek
 * @date 17.05.2021, 16:46
 */

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $product \frontend\models\Product */

?>

<div class="product-details">
    <h1 class="product-name"><?= $product->name ?></h1>
    <div class="product-meta">
        <?php if ($product->brand): ?>
            <?= t('Brand') ?>: <span class="product-brand"><?= $product->brand->name ?></span>
        <?php endif; ?>
    </div>
    <div class="product-price"><?= $product->formattedPrice ?></div>
    <div class=""><b><?= t('v Rassrochku') ?> </b><?= Yii::$app->formatter->asSum($product->loan_price) ?></div>
    <div class=""><b><?= Yii::t('app', 'v Rassrochku Month {price}', [
                'price' => Yii::$app->formatter->asSum($product->loan_price / 12)
            ]) ?> </b>
    </div>
    <?php if ($product->short_description): ?>
        <p class="product-short-desc">
            <?= Yii::$app->formatter->asHtml($product->short_description) ?></p>
    <?php endif ?>

    <hr class="product-divider">

    <div class="product-form product-qty">
        <label><?= t('Soni') ?>:</label>
        <div class="product-form-group">
            <div class="input-group">
                <button class="quantity-minus d-icon-minus"></button>
                <input class="quantity form-control" type="number" min="1"
                       max="1000000" readonly name="qty" id="quantity-input">
                <button class="quantity-plus d-icon-plus"></button>
            </div>
        </div>
    </div>

    <hr class="product-divider">

    <div class="product-form product-qty">
        <div class="product-form-group">
            <a href="<?= to(['cart/add', 'product_id' => $product->id]) ?>"
               class="btn-product detail-btn-cart" id="add-to-cart-from-detail-page">
                <i class="d-icon-bag"></i>
                <?= t('Add to cart') ?>
            </a>
        </div>

        <div class="product-form-group">
            <a href="<?= to(['shop/loan', 'product_id' => $product->id]) ?>"
               class="btn-product detail-btn-cart">
                <i class="d-icon-money"></i>
                <?= t('kupit v Rassrochku') ?>
            </a>
        </div>
    </div>

    <hr class="product-divider mb-3">

    <div class="product-footer">
        <?php $url = Yii::$app->urlManager->createAbsoluteUrl(Url::current()) ?>
        <div class="social-links mr-4">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>"
               class="social-link social-facebook fab fa-facebook-f"></a>
            <a href="https://telegram.me/share/url?url=<?= $url ?>"
               class="social-link social-telegram fab fa-telegram-plane"></a>
            <a href="https://twitter.com/intent/tweet?url=<?= $url ?>"
               class="social-link social-twitter fab fa-twitter"></a>
            <a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?= $url ?>"
               class="social-link social-odnoklassniki fab fa-odnoklassniki"></a>
        </div>
        <span class="divider d-lg-show"></span>
        <div class="product-action">

            <?php if (!is_guest()): ?>
                <a href="<?= to(['wish/add-to-wishlist', 'product_id' => $product->id]) ?>"
                   class="mr-6 add-to-wishlist-btn">
                    <i class="<?= !$product->isWished ? 'd-icon-heart' : 'd-icon-heart-full' ?>"></i>
                </a>
            <?php endif ?>
        </div>
    </div>

</div>