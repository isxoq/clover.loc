<?php
/** @var \backend\modules\postmanager\models\Post $post */
use yii\helpers\Html;

$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t("app", 'Our blog'), 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-content with-sidebar">
    <div class="container">
        <div class="row gutter-lg">
            <div class="col-lg-9">
                <article class="post-single">
                    <figure class="post-media">
                        <a href="">
                            <img src="<?=$post->largeImage?>" width="880" height="450" alt="post" />
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-meta">

                            <i class="fa fa-calendar-alt"></i> <a href="#" class="post-date"><?=Yii::$app->formatter->asDate($post->published_at)?></a>
                        </div>
                        <h4 class="post-title"><a href="#"><?=$post->title?></a></h4>
                        <div class="post-body mb-7">
                            <p class="mb-5"> <?=$post->short_description?></p>
                            <?= Yii::$app->getFormatter()->asHtml($post->content) ?>
                        </div>
                    </div>
                </article>
                <nav class="page-nav">
                    <a class="pager-link pager-link-prev" href="#">
                        Previous Post
                        <span class="pager-link-title">Cras iaculis ultricies nulla</span>
                    </a>
                    <a class="pager-link pager-link-next" href="#">
                        Go To Post
                        <span class="pager-link-title">Praesent placerat risus</span>
                    </a>
                </nav>
                <!-- End Page Navigation -->
                <?=$this->render('_related_posts')?>
            </div>

            <aside class="col-lg-3 right-sidebar sidebar-fixed sticky-sidebar-wrapper">
                <?= $this->render('_sidebar') ?>
            </aside>

        </div>
    </div>
</div>