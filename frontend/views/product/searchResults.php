<?php

use soft\helpers\Url;

/* @var $this \soft\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $minPriceFromAll int */
/* @var $maxPriceFromAll int */

$this->title = t('Search results');
$this->addBreadCrumb($this->title);

$this->params['cssFiles'] = [
    'vendor/nouislider/nouislider.min.css'
];
$this->params['jsFiles'] = [
    'vendor/sticky/sticky.min.js',
    'vendor/imagesloaded/imagesloaded.pkgd.min.js',
    'vendor/nouislider/nouislider.min.js'
];
?>

<div class="page-content mb-10 pb-2">
    <div class="container">

        <form action="<?= Url::current() ?>" method="get" id="filer-and-sort-form">

            <input type="hidden" name="key" value="<?= Yii::$app->request->get('key') ?>">

            <div class="row main-content-wrap gutter-lg">
                <aside class="col-lg-4 col-xl-3 sidebar sidebar-fixed shop-sidebar sticky-sidebar-wrapper">
                    <?= $this->render('products_partials/_sidebar', [
                        'maxPriceFromAll' => $maxPriceFromAll,
                        'minPriceFromAll' => $minPriceFromAll,
                    ]) ?>
                </aside>
                <div class="col-lg-8 col-xl-9 main-content">
                    <?= $this->render('products_partials/_products', [
                        'dataProvider' => $dataProvider
                    ]) ?>
                </div>
            </div>

        </form>
    </div>
</div>