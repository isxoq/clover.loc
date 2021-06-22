<?php
/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 10:44
 */

use soft\helpers\Url;

/* @var $this \soft\web\View */
/* @var $product array|\frontend\models\Product */
?>


<div class="product product-single row product-popup">
    <div class="col-md-6">
        <div class="product-gallery">
            <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1"
                 style="min-height: 350px">
                <?php foreach ($product->getImages('original') as $image): ?>

                    <figure class="product-image">
                        <img src="<?= $image ?>"
                             data-zoom-image="<?= $image ?>" alt=""
                             style="max-height: 550px; width: 100%;">
                    </figure>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="product-details scrollable pr-0 pr-md-3">
            <h1 class="product-name mt-0"><?= e($product->name) ?></h1>
            <div class="product-meta">
                <?php if ($product->brand): ?>
                    <?= t('Brand') ?>: <span class="product-brand"><?= $product->brand->name ?></span>
                <?php endif; ?>
            </div>
            <div class="product-price"><?= $product->formattedPrice ?></div>
            <?php if ($product->short_description): ?>
                <p class="product-short-desc"><?= Yii::$app->formatter->asHtml($product->short_description) ?></p>
            <?php endif ?>
            <div class="product-detail-old-price">

                <?php if ($product->hasDiscount): ?>
                    <span>
                    <del>    <?= $product->formattedOldPrice ?></del>
                    </span>
                <?php endif ?>

            </div>

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
                    <a href="<?= to(['cart/add', 'product_id' => $product->id]) ?>"
                       class="btn-product detail-btn-cart" id="add-to-cart-from-detail-page">
                        <i class="d-icon-bag"></i>
                        <?= t('Add to cart') ?>
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
    </div>
</div>