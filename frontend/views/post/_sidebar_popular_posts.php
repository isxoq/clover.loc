<?php

use backend\modules\postmanager\models\Post;
use yii\helpers\Url;
use yii\helpers\Html;

$posts = Post::find()
    ->active()
    ->published()
    ->recently()
    ->limit(4)
    ->all();

?>

<div class="widget widget-collapsible">
    <h3 class="widget-title"><?=Yii::t('app','Popular articles')?></h3>
    <div class="widget-body">
        <div class="post-col">
            <?php foreach ($posts as $popular_post):?>
                <?php $detailUrl = Url::to(['post/detail','slug'=>$popular_post->slug])?>
            <div class="post post-list-sm">
                <figure class="post-media">
                    <a href="<?=$detailUrl?>">
                        <img src="<?=$popular_post->smallImage?>" width="90" height="90"
                             alt="post" />
                    </a>
                </figure>
                <div class="post-details">
                    <div class="post-meta">
                        <a href="<?=$detailUrl?>" class="post-date"><?=$popular_post->getDateFormat()?></a>
                    </div>
                    <h4 class="post-title">
                        <a href="<?=$detailUrl?>">
                            <?=Html::encode($popular_post->title)?>
                        </a>
                    </h4>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>