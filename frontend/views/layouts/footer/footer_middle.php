<?php

use soft\helpers\SiteHelper;

$acf = Yii::$app->acf;

$phoneNumber = $acf->getValue('site_phone_number');
$email = $acf->getValue('email_address');

?>

<div class="footer-middle">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-info">
                <h4 class="widget-title">Contact Info</h4>
                <ul class="widget-body">
                    <li>
                        <label>Phone:</label>
                        <a href="tel:<?= SiteHelper::clearPhoneNumber($phoneNumber) ?>"><?= $phoneNumber ?></a>
                    </li>
                    <li>
                        <label>Email:</label>
                        <a href="mailto:<?= $email ?>"><?= $email ?></a>
                    </li>
                    <li>
                        <label>Address:</label>
                        <a href="#"><?= $acf->getValue('office_address') ?></a>
                    </li>
                    <li>
                        <label>WORKING DAYS / HOURS:</label>
                    </li>
                    <li>
                        <a href="#"><?= $acf->getValue('working_days') ?></a>
                    </li>
                </ul>
            </div>
            <!-- End Widget -->
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget ml-lg-4">
                <h4 class="widget-title"><?=t('About us')?></h4>
                <ul class="widget-body">
                    <li>
                        <a href="<?=to(['site/about'])?>"><?=t('About us')?></a>
                    </li>
                    <li>
                        <a href="#">Order History</a>
                    </li>
                    <li>
                        <a href="#">Returns</a>
                    </li>
                    <li>
                        <a href="#">Custom Service</a>
                    </li>
                    <li>
                        <a href="#">Terms &amp; Condition</a>
                    </li>
                </ul>
            </div>
            <!-- End Widget -->
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget ml-lg-4">
                <h4 class="widget-title"><?=t('My account')?></h4>
                <ul class="widget-body">
                    <?php if (Yii::$app->user->isGuest):?>
                    <li>
                        <a href="<?=to(['site/login'])?>"><?=t('Login to the site')?></a>
                    </li>
                    <?php endif;?>
                    <li>
                        <a href="<?=to(['shop/view-cart'])?>"><?=t('View cart')?></a>
                    </li>
                    <li>
                        <a href="<?=to(['profile/wishlist'])?>"><?=t('Wishlist')?></a>
                    </li>
                    <li>
                        <a href="#">Track My Order</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                </ul>
            </div>
            <!-- End Widget -->
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-instagram">
                <h4 class="widget-title">Instagram</h4>
                <figure class="widget-body row">
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/01.jpg" alt="instagram 1" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/08.jpg" alt="instagram 8" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/07.jpg" alt="instagram 7" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/06.jpg" alt="instagram 6" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/05.jpg" alt="instagram 5" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/04.jpg" alt="instagram 4" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/03.jpg" alt="instagram 3" width="64" height="64"/>
                    </div>
                    <div class="col-3">
                        <img src="/template/riode/images/instagram/02.jpg" alt="instagram 2" width="64" height="64"/>
                    </div>
                </figure>
            </div>
            <!-- End Instagram -->
        </div>
    </div>
</div>
<!-- End FooterMiddle -->