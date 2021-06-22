<?php

use backend\modules\postmanager\models\PostCategory;

$post_categories = PostCategory::find()
    ->active()
    ->all();
?>

<div class="widget widget-collapsible border-no">
    <h3 class="widget-title"><?=Yii::t('app','Blog categories')?></h3>
    <ul class="widget-body filter-items search-ul">
        <?php foreach ($post_categories as $post_category): ?>
            <?php $detailUrl = to(['post/category', 'slug' => $post_category->slug]); ?>
            <li><a href="<?= $detailUrl ?>"><?= $post_category->name ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
