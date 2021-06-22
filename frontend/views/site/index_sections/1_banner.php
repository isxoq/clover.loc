<?php

use yii\helpers\Url;
use backend\models\Banner;

$banners = Banner::find()
    ->active()
    ->all();

?>


<section class="intro-section container">
    <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-8 mb-4 mb-lg-0">
            <div class="intro-slider animation-slider owl-carousel owl-theme owl-dot-inner row cols-1 gutter-no"
                 data-owl-options="{
                                'items': 1,
                                'dots': true,
                                'loop': true
                            }">
                <?php foreach ($banners as $banner): ?>
                    <?php if ($banner->is_right == false): ?>
                        <div class="intro-slide1 banner banner-fixed" style="background-color: #e8e8ea">
                            <figure>
                                <img src="<?= $banner->getImageUrl() ?>" alt="banner" width="580"
                                     height="460"/>
                            </figure>
                            <div
                                    class="banner-content x-50 y-50 text-center d-flex flex-column align-items-center">
                                <h4 class="banner-subtitle text-body font-weight-normal slide-animate"
                                    data-animation-options="{'name': 'fadeInUp', 'duration': '1.5s'}"><?= $banner->title ?></h4>
                                <h3 class="banner-title slide-animate"
                                    data-animation-options="{'name': 'fadeInUp', 'duration': '1.5s','delay': '.3s'}">
                                    <?= $banner->description ?></h3>
                                <p class="font-weight-semi-bold text-grey slide-animate"
                                   data-animation-options="{'name': 'fadeInLeftShorter', 'duration': '1.2s','delay': '.3s'}">
                                    <?= $banner->text1 ?></p>
                                <div class="banner-price-info ls-s text-uppercase text-primary font-weight-bold flex-1 slide-animate"
                                     data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1.2s','delay': '.8s'}">
                                    <?= $banner->text2 ?>
                                </div>
                                <?php if ($banner->urlName): ?>
                                    <a href="<?= Url::to([$banner->url]) ?>"
                                       class="btn btn-outline btn-dark btn-rounded slide-animate"
                                       data-animation-options="{'name': 'fadeIn', 'duration': '1.2s','delay': '1s'}"><?= $banner->urlName ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php $i = 0 ?>
        <?php foreach ($banners as $banner_right): ?>
            <?php if (($banner_right->is_right == true) && $i != 1): ?>
                <div class="col-xl-3 col-lg-3 col-md-4 mb-4">
                    <div class="intro-banner banner banner-fixed overlay-dark">
                        <figure>
                            <img class="x-50" src="<?= $banner_right->getImageRightUrl() ?>" alt="product"
                                 width="346" height="193"/>
                        </figure>
                        <div class="banner-content x-50 y-50 text-center d-flex flex-column align-items-center">
                            <p class="text-white font-primary text-uppercase flex-1 lh-1 appear-animate"
                               data-animation-options="{
                                        'name': 'maskUp'
                                    }"><?= $banner_right->title ?> <br/><span
                                        class="d-inline-block mt-1 ls-normal"><?= $banner_right->description ?></span>
                            </p>
                            <h4 class="banner-subtitle mb-1 text-uppercase ls-normal font-weight-normal appear-animate"
                                data-animation-options="{
                                        'name': 'fadeInDownShorter',
                                        'delay': '.3s'
                                    }"><?= $banner_right->text1 ?></h4>
                            <h3 class="banner-title ls-md font-weight-bold appear-animate"
                                data-animation-options="{
                                        'name': 'fadeInDownShorter',
                                        'delay': '.2s'
                                    }"><?= $banner_right->text2 ?></h3>
                            <?php if ($banner_right->urlName): ?>
                                <a href="<?= $banner_right->url ?>"
                                   class="btn btn-dark btn-md btn-rounded appear-animate"
                                   data-animation-options="{
                                        'name': 'fadeInDownShorter'
                                    }"><?= $banner_right->urlName ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php $i = 1 ?>
        <?php endforeach; ?>
    </div>
</section>