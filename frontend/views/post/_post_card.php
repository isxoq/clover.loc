<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var \backend\modules\postmanager\models\Post $post */
/** @var \soft\web\View $this */

$detailUrl = Url::to(['post/detail', 'slug' => $post->slug]);


?>


<article class="post post-classic mb-7">
    <figure class="post-media overlay-zoom">
        <a href="<?= $detailUrl ?>">
            <img src="<?= $post->largeImage ?>" width="870" height="420" alt="post">
        </a>
    </figure>
    <div class="post-details">
        <div class="post-meta">
            <a href="<?=$detailUrl?>" class="post-date"><?=$post->getDateFormat()?></a>
        </div>
        <h4 class="post-title">
            <a href="<?= $detailUrl ?>">
               <?= Html::encode($post->title) ?>
            </a>
        </h4>
        <a href="<?= $detailUrl ?>" class="btn btn-link btn-underline btn-primary">
            <?= Yii::t('app', 'Read more') ?>
            <i class="d-icon-arrow-right"></i></a>
    </div>
</article>