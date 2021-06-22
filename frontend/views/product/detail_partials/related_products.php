<?php

/*
 * @author Shukurullo Odilov
 * @date 15.05.2021, 9:42
 */

/* @var $this \yii\web\View */
/** @var \frontend\models\Product $product */

?>
<section class="product-wrapper mb-4">
    <h2 class="title mb-0 d-block text-center"><?= t('Related products') ?>
    </h2>
    <br>
    <div class="owl-carousel owl-theme owl-nav-full owl-split row cols-2 cols-md-3 cols-lg-4 gutter-xs"
         data-owl-options="{ 'items': 5, 'nav': true, 'loop': false, 'dots': false, 'margin': 1, 'responsive': { '0': { 'items': 2 }, '768': { 'items': 3 }, '992': { 'items': 4 } } }">
        <?php foreach ($product->relatedProducts() as $relatedProduct): ?>
            <?php $detailUrl = $relatedProduct->detailUrl ?>
            <div class="product text-center">
                <figure class="product-media">
                    <a href="<?= $detailUrl ?>">
                        <img src="<?= $relatedProduct->getImage() ?>" alt="product" width="220" style="height: 206px">
                    </a>
                    <div class="product-action-vertical">
                        <?= $relatedProduct->addToCartButton ?>
                        <?= $relatedProduct->wishlistButton ?>
                    </div>
                    <div class="product-action">
                        <?= $relatedProduct->quickViewButton ?>
                    </div>
                </figure>
                <div class="product-details">
                    <h3 class="product-name">
                        <a href="<?= $detailUrl ?>"><?= $relatedProduct->name ?></a>
                    </h3>
                    <div class="product-price">
                        <ins class="new-price"><?= $relatedProduct->formattedPrice ?></ins>
                        <?php if ($relatedProduct->hasDiscount): ?>
                            <del class="old-price"><?= $relatedProduct->formattedOldPrice ?></del>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
