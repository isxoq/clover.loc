<?php

use yii\helpers\Url;

?>
<!-- Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="<?= Url::to(['/']) ?>" class="sticky-link active">
        <i class="d-icon-home"></i>
        <span><?= Yii::t('app', 'Home') ?></span>
    </a>
    <?php if (!Yii::$app->user->isGuest):?>
    <a href="<?= Url::to(['profile/wishlist']) ?>" class="sticky-link">
        <i class="d-icon-heart"></i>
        <span><?= Yii::t('app', 'Wishlist') ?></span>
    </a>
    <?php endif;?>
    <a href="<?= Yii::$app->user->isGuest ? Url::to(['auth/login']) : Url::to(['profile/account']) ?>" class="sticky-link">
        <i class="d-icon-user"></i>
        <span><?= t('Account') ?></span>
    </a>
    <div class="header-search hs-toggle dir-up">
        <a href="#" class="search-toggle sticky-link">
            <i class="d-icon-search"></i>
            <span><?= Yii::t('app', 'Search') ?></span>
        </a>
        <form action="<?= Url::to(['product/search']) ?>" class="input-wrapper">
            <input type="text" class="form-control" name="key" autocomplete="off"
                   value="<?= Yii::$app->request->get('key') ?>"
                   placeholder="<?= Yii::t('app', 'Search') ?>..." required/>
            <button class="btn btn-search" type="submit">
                <i class="d-icon-search"></i>
            </button>
        </form>
    </div>
</div>