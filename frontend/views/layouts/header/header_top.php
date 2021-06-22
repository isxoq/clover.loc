<?php

use yii\helpers\Url;

?>
<div class="header-top">
    <div class="container">
        <div class="header-left">
            <p class="welcome-msg pb-2"><?= Yii::t('app', 'welcome to the store') ?></p>
        </div>
        <div class="header-header header-borderright">
            <!-- End DropDown Menu -->
            <div class="dropdown dropdown-expanded">
                <a href="#dropdown">Links</a>
                <ul class="dropdown-box">
                    <li><a href="<?= to(['site/about']) ?>"><?= Yii::t('app', 'About us') ?></a></li>
                    <li><a href="<?= Url::to(['post/all']) ?>"><?= Yii::t('app', 'Our blog') ?></a></li>
                    <li><a href="<?= Url::to(['site/faq']) ?>">FAQ</a></li>
                    <li><a href="#">Newsletter</a></li>
                    <li><a href="<?= to(['shop/contact']) ?>"><?= Yii::t('app', 'Contacts') ?></a></li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li>
                            <a class="login-link" href="<?= to(['auth/login']) ?>">
                                <i class="fas fa-sign-in-alt"></i>
                                <?= t('Login to the site') ?>
                            </a>
                        </li>
                        <li><a class="register-link ml-0"
                               href="<?= to(['auth/signup']) ?>">
                                <i class="fas fa-user-lock" aria-hidden="true"></i>
                                <?= t('Register') ?></a>
                        </li>
                    <?php else: ?>
                        <li><?= a('<i class="d-icon-user"></i>&nbsp;&nbsp;' . t('Account') . " (" . Yii::$app->user->identity->username . ")", ['profile/account']) ?></li>
                    <?php endif; ?>


                </ul>
            </div>

        </div>
    </div>
</div>