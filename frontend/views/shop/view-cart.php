<?php

$this->title = Yii::t('app', 'View cart');
$this->params['breadcrumbs'][] = $this->title;
$this->params['mainClass'] = 'cart';

?>
<!--<main class="main cart">-->
<div class="page-content pt-7 pb-10">

    <?= $this->render('partials/_checkout_menu', [
        'completed' => $completed
    ]) ?>

    <div class="container mt-7 mb-2" id="cart-content-view">

        <?= $this->render('_cart_content') ?>

    </div>
</div>
<!--</main>-->
<!-- End Main -->