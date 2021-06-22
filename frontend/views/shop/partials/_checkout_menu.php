<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/20/2021
 * Time: 10:43 AM
 * Project name: shop
 */

?>

<div class="step-by pr-4 pl-4">
    <h3 class="title title-simple title-step <?= Yii::$app->request->url == to(['shop/view-cart']) ? "active" : "" ?>">
        <a
                href="<?= to(['shop/view-cart']) ?>"><?= t('Shopping Cart') ?></a></h3>
    <h3 class="title title-simple title-step <?= (Yii::$app->request->url == to(['shop/checkout'])) && ($completed == false) ? "active" : "" ?>">
        <a href="<?= to(['shop/checkout']) ?>"><?= t('Checkout') ?></a></h3>
    <h3 class="title title-simple title-step <?= (Yii::$app->request->url == to(['shop/checkout'])) && ($completed == true) ? "active" : "" ?>">
        <a href="#"><?= t('Order Complete') ?></a></h3>
</div>
