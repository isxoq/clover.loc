<?php

use yii\bootstrap4\LinkPager;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>

<nav class="toolbox toolbox-pagination">

    <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
        'nextPageLabel' => Yii::t('app', 'Next') . '<i class="d-icon-arrow-right"></i>',
        'prevPageLabel' => '<i class="d-icon-arrow-left"></i>' . Yii::t('app', 'Prev') ,
        'prevPageCssClass' => 'page-link-prev',
        'nextPageCssClass' => 'page-link-next',
    ]) ?>

</nav>
