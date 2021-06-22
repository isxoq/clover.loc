<?php
/*
 * @author Shukurullo Odilov
 * @date 15.05.2021, 9:42
 */


/* @var $this \soft\web\View */
/* @var $product \frontend\models\Product */
?>

<div class="product-gallery">
    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
        <?php foreach ($product->getImages('original') as $image): ?>
            <figure class="product-image">
                <img src="<?= $image ?>"
                     data-zoom-image="<?= $image ?>"
                     alt="" width="800" height="900">
            </figure>
        <?php endforeach; ?>
    </div>
    <div class="product-thumbs-wrap">
        <div class="product-thumbs">

            <?php foreach ($product->getImages() as $key => $image): ?>
                <div class="product-thumb <?= $key == 0 ? 'active' : '' ?>">
                    <img src="<?= $image ?>"
                         alt="product thumbnail" width="109" height="122">
                </div>
            <?php endforeach; ?>

        </div>
        <button class="thumb-up disabled"><i
                class="fas fa-chevron-left"></i></button>
        <button class="thumb-down disabled"><i
                class="fas fa-chevron-right"></i></button>
    </div>
</div>
