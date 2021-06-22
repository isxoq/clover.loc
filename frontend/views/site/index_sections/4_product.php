<?php

use frontend\models\Category;
use backend\models\RecommendedCategory;

$recommendedCategories = RecommendedCategory::find()
    ->active()
    ->all();
?>
<section class="grey-section pt-10 pb-8">
    <div class="container pt-4 pb-4">
        <?php foreach ($recommendedCategories as $key => $recommendedCategory): ?>
            <?php
            $class = '';
            if ($key == 0) {
                $class = "";
            }
            if ($key == 1) {
                $class = "mt-10 pt-4";
            }
            if ($key == 2) {
                $class = "mt-10 pt-2";
            }
            if ($key == 3) {
                $class = "mt-10";
            }
            ?>
            <div class="product-wrapper row gutter-no appear-animate <?= $class ?>">
                <div class="row gutter-no products-banner">
                    <div class="col-12 col-xs-6">
                        <div class="category-filters d-flex flex-column">
                            <h3 class="category-title font-weight-bold appear-animate"
                                data-animation-options="{
                                            'name': 'fadeInUpShorter'
                                        }"><?= $recommendedCategory->category->title ?></h3>
                            <ul class="cateogry-list appear-animate" data-animation-options="{
                                            'name': 'fadeInUpShorter',
                                            'delay': '.3s'
                                        }">
                                <?php foreach ($recommendedCategory->category->activeSubCategories as $subCategory): ?>
                                    <li>
                                        <a href="<?= to(['product/category', 'slug' => $subCategory->slug]) ?>"><?= $subCategory->title ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="<?= to(['product/category', 'slug' => $recommendedCategory->category->slug]) ?>"
                               class="btn btn-link btn-underline font-primary appear-animate"
                               data-animation-options="{
                                            'name': 'fadeInUpShorter',
                                            'delay': '.3s'
                                        }"><?= Yii::t('app', 'All products') ?><i class="d-icon-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="banner col-12 col-xs-6"
                         style="background-image: url('<?= $recommendedCategory->getImageUrl() ?>'); background-color: #ebebeb">
                        <div class="banner-content appear-animate" data-animation-options="{
                                        'name': 'fadeInUpShorter',
                                        'delay': '.4s'
                                    }">
                            <h4 class="banner-subtitle mb-2 ls-s font-weight-normal"><?= $recommendedCategory->text1 ?></h4>
                            <h3 class="banner-title ls-s"><?= $recommendedCategory->text2 ?><br/><span
                                        class="d-inline-block font-weight-normal"><?= $recommendedCategory->text3 ?></span>
                            </h3>
                            <?php if ($recommendedCategory->button_label): ?>
                                <a href="<?= $recommendedCategory->url ?>"
                                   class="btn btn-dark btn-md btn-rounded"><?= $recommendedCategory->button_label ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?= $this->render('4_1_category_products', compact('recommendedCategory')); ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>