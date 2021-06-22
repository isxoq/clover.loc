<?php

use backend\modules\postmanager\models\Post;


$post_blogs = Post::find()
    ->active()
    ->published()
    ->recently()
    ->limit(4)
    ->all();

?>
<section class="blog container mt-10 pt-3 mb-10 appear-animate">
    <h2 class="title title-underline title-line mb-4"><?=Yii::t('app','Our blog')?></h2>
    <div class="owl-carousel owl-theme row cols-lg-4 cols-md-3 cols-sm-2 cols-1" data-owl-options="{
                        'items': 4,
                        'margin': 20,
                        'loop': false,
                        'responsive': {
                            '0': {
                                'items': 1
                            },
                            '576': {
                                'items': 2
                            },
                            '768': {
                                'items': 3
                            },
                            '992': {
                                'items': 4
                            }
                        }
                    }">
        <?php foreach ($post_blogs as $post_blog): ?>

            <?php $detailUrl = to(['post/detail', 'slug' => $post_blog->slug]) ?>

            <div class="post overlay-zoom appear-animate overlay-dark" data-animation-options="{
                            'name': 'zoomInShorter'
                        }">
                <figure class="post-media">
                    <a href="<?= $detailUrl ?>">
                        <img src="<?= $post_blog->smallImage ?>" width="280" style="height: 189px" alt="post"/>
                    </a>
                </figure>
                <div class="post-details">
                    <div class="post-meta">
                        <a href="<?=$detailUrl?>" class="post-date">
                            <?= Yii::$app->formatter->asDate($post_blog->published_at) ?>
                        </a>

                    </div>
                    <h3 class="post-title"><a href="<?= $detailUrl ?>"><?= $post_blog->title ?></a></h3>
                    <a href="<?= $detailUrl ?>" class="btn btn-link btn-underline btn-sm"><?=Yii::t('app','Read more')?><i
                                class="d-icon-arrow-right"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>