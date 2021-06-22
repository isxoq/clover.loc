<?php

use yii\helpers\Url;

$acf = Yii::$app->acf;
$phoneNumber = $acf->getValue('site_phone_number');

?>
<div class="header-middle sticky-header fix-top sticky-content">
    <div class="container">
        <div class="header-left">
            <a href="#" class="mobile-menu-toggle">
                <i class="d-icon-bars2"></i>
            </a>
            <a href="<?= Url::to(['/']) ?>" class="logo">
                <img src="<?= $acf->getValue('Logo') ?>" alt="logo" width="154" height="43"/>
            </a>
            <!-- End Logo -->

            <div class="header-search hs-simple">
                <form action="<?= Url::to(['product/search']) ?>" class="input-wrapper">
                    <input type="text" class="form-control" name="key" autocomplete="off"
                           value="<?= Yii::$app->request->get('key') ?>"
                           placeholder="<?= Yii::t('app', 'Search') ?>..." required/>
                    <button class="btn btn-search" type="submit">
                        <i class="d-icon-search"></i>
                    </button>
                </form>
            </div>
            <!-- End Header Search -->
        </div>
        <div class="header-right">
            <a href="tel:<?= $phoneNumber ?>" class="icon-box icon-box-side">
                <div class="icon-box-icon">
                    <i class="d-icon-phone"></i>
                </div>
                <div class="icon-box-content d-lg-show">
                    <h4 class="icon-box-title"><?= Yii::t('app', 'call us now') ?></h4>
                    <p><?= $phoneNumber ?></p>
                </div>
            </a>
            <span class="divider"></span>
            <a href="<?= Url::to(['profile/wishlist']) ?>" class="wishlist">
                <i class="d-icon-heart"></i>
            </a>
            <span class="divider"></span>

            <div class="dropdown cart-dropdown type2 mr-0 mr-lg-2" id="header-cart-container">

                <?= $this->render('_header_cart_content') ?>


            </div>
            <div class="header-search hs-toggle mobile-search">
                <a href="#" class="search-toggle">
                    <i class="d-icon-search"></i>
                </a>
                <form action="#" class="input-wrapper">
                    <input type="text" class="form-control" name="search" autocomplete="off"
                           placeholder="Search your keyword..." required/>
                    <button class="btn btn-search" type="submit">
                        <i class="d-icon-search"></i>
                    </button>
                </form>
            </div>
            <!-- End of Header Search -->
        </div>
    </div>

</div>