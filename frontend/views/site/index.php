<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this soft\web\View */

$this->title = 'Online shopping by iTeach company';
$this->params['bodyClass'] = 'home';
$this->params['mainClass'] = 'mt-lg-4';


?>

<div class="page-content">
    <?= $this->render('index_sections/1_banner') ?>

    <?= $this->render('index_sections/2_top_categories') ?>
    <?= $this->render('index_sections/3_banner_group') ?>
    <?= $this->render('index_sections/4_product') ?>
    <?= $this->render('index_sections/5_service') ?>
    <?= $this->render('index_sections/6_from_blog') ?>
</div>


