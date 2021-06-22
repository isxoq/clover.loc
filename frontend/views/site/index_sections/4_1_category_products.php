<?php
/** @var \soft\web\View $this */
/** @var \backend\models\RecommendedCategory $recommendedCategory */

?>
<div class="overflow-hidden products-box">
    <div class="row gutter-no line-grid">
        <?php foreach ($recommendedCategory->category->randomActiveProducts() as $product):?>
            <?= $this->render('4_2_product_card', ['product' => $product]) ?>
        <?php endforeach;?>
    </div>
</div>
