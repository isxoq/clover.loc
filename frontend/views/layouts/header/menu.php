<?php

use yii\helpers\Url;
use frontend\models\FrontendModel;

/* @var $this \soft\web\View */

$mainCategories = FrontendModel::activeMainCategoriesForHeaderMenu(true);
$fixedClass = Yii::$app->controller->route == 'site/index' ? 'fixed' : '';

$menuTop = \backend\modules\menumanager\models\Menu::getMenu('menu_top');


?>

<div class="header-bottom has-dropdown pb-0">
    <div class="container d-flex align-items-center">
        <div class="dropdown category-dropdown has-border <?= $fixedClass ?>">
            <a href="#" class="text-white font-weight-semi-bold category-toggle"><i
                        class="d-icon-bars2"></i><span><?= Yii::t('app', 'Categories') ?></span></a>
            <!-- <div class="dropdown-overlay"></div> -->
            <div class="dropdown-box">
                <ul class="menu vertical-menu category-menu">
                    <li>
                        <a href="#" class="menu-title">
                            <?= Yii::t('app', 'Categories') ?>
                        </a>
                    </li>
                    <?php foreach ($mainCategories as $category): ?>

                        <?php

                        $subCategories = $category['activeSubCategories'];
                        $hasSubCategories = !empty($subCategories);

                        ?>

                        <li class="<?= $hasSubCategories ? 'submenu' : '' ?>">
                            <a href="<?= to(['product/category', 'slug' => $category['slug']]) ?>">
                                <?= FrontendModel::renderCategoryIcon($category['icon_type'], $category['icon']) ?> <?= $category['translation']['title'] ?>
                            </a>
                            <?php if ($hasSubCategories): ?>
                                <ul>
                                    <?php foreach ($subCategories as $subCategory): ?>
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
        <nav class="main-nav ml-4">
            <ul class="menu">

                <?php if ($menuTop): ?>
                    <?php foreach ($menuTop->activeSubMenus as $menu): ?>

                        <?php if ($menu->activeSubMenus): ?>
                            <li>
                                <a href="<?= $menu->url ?>"><?= $menu->titleName ?></a>
                                <ul>

                                    <?php foreach ($menu->activeSubMenus as $subMenu): ?>
                                        <li><a href="<?= $subMenu->url ?>"><?= $subMenu->titleNames ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?= $menu->url ?>"><?= $menu->titleName ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach ?>
                <?php endif; ?>

            </ul>
        </nav>
        <div class="d-flex align-items-center ml-auto">
            <?= $this->render('_selectLanguage') ?>
        </div>
    </div>
</div>