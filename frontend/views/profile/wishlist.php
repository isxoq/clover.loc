<?php

/** @var \soft\web\View $this */

/** @var \frontend\models\Product[] $wishedProducts */

use yii\helpers\Url;

$this->title = Yii::t('app', 'Wishlist');

$this->addBreadCrumb($this->title);
?>

<div class="page-content pt-10 pb-10 mb-2" id="wishlist_content">
    <div class="container">
        <?php if (!$wishedProducts) { ?>
            <div class="alert alert-light alert-danger alert-icon alert-inline mb-4">
                <i class="fas fa-exclamation-triangle"></i>
                <?= Yii::t('app', 'you do not have the selected product') ?>
                <button type="button" class="btn btn-link btn-close">
                    <i class="d-icon-times"></i>
                </button>
            </div>
        <?php } else { ?>
            <table class="shop-table wishlist-table mt-2 mb-4">
                <thead>
                <tr>
                    <th class="product-name"><span><?= Yii::t('app', 'Product') ?></span></th>
                    <th></th>
                    <th class="product-price"><span><?= Yii::t('app', 'Price') ?></span></th>
                    <th class="product-stock-status"><span><?= Yii::t('app', 'Status') ?></span></th>
                    <th class="product-add-to-cart"></th>
                    <th class="product-remove"></th>
                </tr>
                </thead>
                <tbody class="wishlist-items-wrapper">
                <?php foreach ($wishedProducts as $product): ?>
                    <tr>
                        <td class="product-thumbnail">
                            <a href="<?= Url::to(['product/detail', 'slug' => $product->slug]) ?>">
                                <figure>
                                    <img src="<?= $product->getImage() ?>" width="100" height="100"
                                         alt="product">
                                </figure>
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="<?= Url::to(['product/detail', 'slug' => $product->slug]) ?>"><?= $product->name ?></a>
                        </td>
                        <td class="product-price">
                            <span class="amount"><?= Yii::$app->formatter->asSum($product->price) ?></span>
                        </td>
                        <td class="product-stock-status">
                            <span class="wishlist-in-stock"><?= $product->getStockStatus() ?></span>
                        </td>
                        <td class="product-remove">
                            <div>
                                <a href="<?= Url::to(['wish/remove-from-wishlist', 'product_id' => $product->id]) ?>"
                                   class="remove remove_wishlist" title="Remove this product"><i
                                            class="fas fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
        <div class="social-links share-on">
            <h5 class="text-uppercase font-weight-bold mb-0 mr-4 ls-s">Share on:</h5>
            <a href="#" class="social-link social-icon social-facebook" target="_blank"
               title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-link social-icon social-twitter" target="_blank"
               title="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-link social-icon social-pinterest" target="_blank"
               title="Pinterest"><i class="fab fa-pinterest-p"></i></a>
            <a href="#" class="social-link social-icon social-email" target="_blank"
               title="Email"><i class="far fa-envelope"></i></a>
            <a href="#" class="social-link social-icon social-whatsapp" target="_blank"
               title="Whatsapp"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</div>