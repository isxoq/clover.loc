<?php

/* @var $this \yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\bootstrap4\LinkPager;

$posts = $dataProvider->models;

?>
<div class="posts">

    <?php foreach ($posts as $post) : ?>

        <?= $this->render('_post_card', ['post' => $post]) ?>

    <?php endforeach ?>

</div>

<?= LinkPager::widget([
    'pagination' => $dataProvider->pagination,
    'nextPageLabel' => Yii::t('app', 'Next') . '<i class="d-icon-arrow-right"></i>',
    'prevPageLabel' => '<i class="d-icon-arrow-left"></i>' . Yii::t('app', 'Prev') ,
    'prevPageCssClass' => 'page-link-prev',
    'nextPageCssClass' => 'page-link-next',
]) ?>

