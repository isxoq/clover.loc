<?php
/** @var \backend\modules\postmanager\models\Post[] $posts */

use yii\helpers\Url;
use backend\modules\postmanager\models\Post;

$posts = Post::find()
    ->active()
    ->published()
    ->recently()
    ->limit(4)
    ->all();

?>
<div class="related-posts">
    <h3 class="title title-simple text-left text-normal font-weight-bold ls-normal">
        <?=Yii::t('app','Related posts')?>
    </h3>
    <div class="owl-carousel owl-theme row cols-lg-3 cols-sm-2" data-owl-options="{
                                    'items': 1,
                                    'margin': 20,
                                    'loop': false,
                                    'responsive': {
                                        '576': {
                                            'items': 2
                                        },
                                        '768': {
                                            'items': 3
                                        }
                                    }
                                }">
        <?php foreach ($posts as $related_post): ?>
            <?php $detailUrl = Url::to(['post/detail','slug'=>$related_post->slug])?>
            <div class="post">
                <figure class="post-media">
                    <a href="<?=$detailUrl?>" style=" display: inline; width: 380px; height: 250px">
                        <img src="<?= $related_post->smallImage ?>"  style="width: 380px;height: 250px;object-fit:cover" alt="post"/>
                    </a>
                    <div class="post-calendar">
                        <span class="post-day"><?= $related_post->publishedDay ?></span>
                        <span class="post-month"><?= $related_post->publishedMonth ?></span>
                    </div>
                </figure>
                <div class="post-details">
                    <h4 class="post-title">
                        <a href="<?=$detailUrl?>">
                            <?=$related_post->title?>
                        </a>
                    </h4>
                    <p class="post-content">
                        <?= Yii::$app->formatter->asHtml($related_post->short_description) ?>
                    </p>
                    <a href="<?=$detailUrl?>" class="btn btn-link btn-underline btn-primary">
                       <?=Yii::t('app','Read more')?>
                        <i class="d-icon-arrow-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>