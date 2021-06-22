<?php


/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$products = $dataProvider->models;

?>

<?= $this->render('_sort', [
    'dataProvider' => $dataProvider
]) ?>

    <div class="row cols-2 cols-sm-3 product-wrapper gutter-no split-line">
        <?php foreach ($products as $product): ?>
            <?= $this->render('_product_card', ['product' => $product]) ?>
        <?php endforeach; ?>
    </div>

<?= $this->render('_pagination', [
    'dataProvider' => $dataProvider
]) ?>