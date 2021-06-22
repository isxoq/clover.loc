<?php

use frontend\models\FrontendModel;
use yii\helpers\Url;

/* @var $this \soft\web\View */

$mainCategories = FrontendModel::activeMainCategoriesForHeaderMenu(true);

?>
<!-- MobileMenu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay">
    </div>
    <!-- End Overlay -->
    <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
    <!-- End CloseButton -->
    <div class="mobile-menu-container scrollable">
        <form action="<?= Url::to(['product/search']) ?>" class="input-wrapper">
            <input type="text" class="form-control" name="key" autocomplete="off"
                   placeholder="<?= Yii::t('app', 'Search') ?>..." value="<?= Yii::$app->request->get('key') ?>"
                   required/>
            <button class="btn btn-search" type="submit">
                <i class="d-icon-search"></i>
            </button>
        </form>
        <!-- End Search Form -->
        <div class="tab tab-nav-simple tab-nav-boxed form-tab mt-5">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#menu"><?= t('Menu') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#categories"><?= Yii::t('app', 'Categories') ?></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="menu">
                    <ul class="mobile-menu mmenu-anim">
                        <li class="active">
                            <a href="<?= Url::to(['/site/index']) ?>"><?= Yii::t('app', 'Home') ?></a>
                        </li>
                        <li class="active">
                            <a href="<?= to(['site/about']) ?>"><?= Yii::t('app', 'About us') ?></a>
                        </li>
                        <li class="active">
                            <a href="<?= Url::to(['post/all']) ?>"><?= Yii::t('app', 'Our blog') ?></a>
                        </li>
                        <li class="active">
                            <a href="<?= Url::to(['site/faq']) ?>">FAQ</a>
                        </li>
                        <li class="active">
                            <a href="<?= to(['shop/contact']) ?>"><?= Yii::t('app', 'Contacts') ?></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="categories">
                    <ul class="mobile-menu">
                        <?php foreach ($mainCategories as $category): ?>
                            <li>
                                <a href="<?= to(['product/category', 'slug' => $category['slug']]) ?>">
                                    <?= FrontendModel::renderCategoryIcon($category['icon_type'], $category['icon']) . $category['translation']['title'] ?>
                                </a>
                                <?php if ($category['activeSubCategories']): ?>
                                    <ul>
                                        <?php foreach ($category['activeSubCategories'] as $subCategory): ?>
                                            <li>
                                                <a href="<?= to(['product/category', 'slug' => $subCategory['slug']]) ?>">
                                                    <?= $subCategory['translation']['title'] ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
