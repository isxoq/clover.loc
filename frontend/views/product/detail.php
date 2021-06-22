<?php
/** @var \soft\web\View $this */
/** @var \frontend\models\Product $product */

/** @var \frontend\models\Category $category */

use yii\helpers\Url;
use backend\models\Wishlist;

$user_id = Yii::$app->user->getId();

$this->params['cssFiles'] = [
    'vendor/nouislider/nouislider.min.css',
    'vendor/photoswipe/photoswipe.min.css',
    'vendor/photoswipe/default-skin/default-skin.min.css',
];

$this->params['jsFiles'] = [
    'vendor/photoswipe/photoswipe.min.js',
    'vendor/photoswipe/photoswipe-ui-default.min.js',
];

$this->params['mainClass'] = 'main single-product';
$this->params['bodyClass'] = '';
$this->title = $product->name;
$category = $product->category;
$this->addBreadCrumb($category->title, ['product/category', 'slug' => $category->slug]);
$this->addBreadCrumb($this->title);
?>
<div class="page-content mb-8">
    <div class="container">
        <div class="row gutter-lg">
            <aside class="col-lg-3 right-sidebar sidebar-fixed sticky-sidebar-wrapper">
                <?= $this->render('detail_partials/right_sidebar') ?>
            </aside>
            <div class="col-lg-9">
                <div class="product product-single row mb-10">
                    <div class="col-md-6">
                        <?= $this->render('detail_partials/product_gallery', ['product' => $product]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->render('detail_partials/product_details', ['product' => $product]) ?>
                    </div>
                </div>
                <?= $this->render('detail_partials/product_tabs', ['product' => $product]) ?>

                <?= $this->render('detail_partials/related_products',['product' => $product]) ?>
            </div>
        </div>
    </div>
</div>