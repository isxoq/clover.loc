<?php

use frontend\models\Category;
use yii\helpers\Url;

$categories =  Category::findMainCategories()->active()->with('activeSubCategories')->all();

?>
<section class="categories container mt-10">
    <h2 class="title title-line title-underline border-1 mb-4">Top Categories of the Month</h2>
    <div class="row">
        <?php foreach ($categories as $key => $category):?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="category category-group-image appear-animate" data-animation-options="{
                                'name': 'fadeIn',
                                'delay': '.<?= intval($key)+1?>s'
                            }">
                <a href="#">
                    <figure class="category-media">
                        <img src="<?=$category->getImageUrl()?>" alt="category" width="190"
                             height="169"/>
                    </figure>
                </a>
                <div class="category-content">
                    <h4 class="category-name"><a href="<?=Url::to(['product/category','slug'=>$category->slug])?>"><?=$category->title?></a></h4>
                    <ul class="category-list">
                        <?php foreach ($category->activeSubCategories as $subCategory):?>
                        <li><a href="<?=to(['product/category','slug'=>$subCategory->slug])?>"><?=$subCategory->title?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</section>