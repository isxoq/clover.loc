<?php
?>


    <div class="sidebar-overlay">
        <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
    </div>
    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-left"></i></a>
    <div class="sidebar-content">
        <div class="sticky-sidebar" data-sticky-options="{'top': 89, 'bottom': 70}">

            <?= $this->render('_sidebar_search') ?>
            <?= $this->render('_sidebar_categories') ?>
            <?= $this->render('_sidebar_popular_posts') ?>

        </div>
    </div>

