<?php

/** @var \soft\web\View $this */
/** @var \frontend\models\Category[] $subCategories */

?>
<section class=" pt-4">
    <div class="row">
        <?php foreach ($subCategories as $subCategory): ?>
        <?php $detailUrl =   $subCategory->detailUrl ?>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
            <div class="category category-icon" style="padding-bottom: 10px">
                <a href="<?= $detailUrl ?>">
                    <figure class="category-media">
                        <img src="<?= $subCategory->getImageUrl() ?>" alt="" style="height: 150px; object-fit:cover">
                    </figure>
                    <div class="category-content" style="margin-top: 5px;min-height: 35px">
                        <h4 class="category-name">
                            <?= as_html($subCategory->title) ?>
                        </h4>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

