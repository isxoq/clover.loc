<?php

use backend\models\BannerGroup;

$banner_groups = BannerGroup::find()->active()->all();
?>
<section class="banner-group container mt-10 pb-4 pt-2 mb-10 appear-animate">
    <div class="owl-carousel owl-theme row cols-md-2 cols-1" data-owl-options="{
                        'items': 2,
                        'margin': 20,
                        'dots': true,
                        'responsive': {
                            '0': {
                                'items': 1
                            },
                            '768': {
                                'items': 2,
                                'loop': false
                            },
                            '992': {
                                'dots': false
                            }
                        }
                    }">
        <?php foreach ($banner_groups as $key => $banner_group): ?>
            <?php if ($key % 2 == 0) {

                $name = 'fadeInRightShorter';

            } else {

                $name = 'fadeInLeftShorter';

            } ?>
            <div class="banner<?= $key + 1 ?> banner banner-fixed overlay-zoom appear-animate" data-animation-options="{

                            'name' : '<?= $name ?>' ,
                            'delay': '.<?= $key + 2 ?>s'
                        }" style="background-color: #444443">
                <figure>
                    <img src="<?= $banner_group->getImageUrl() ?>" alt="banner" width="580" style="height: 219px"/>
                </figure>
                <div class="banner-content y-50">
                    <h3 class="banner-title text-white"><?= $banner_group->title ?></h3>
                    <p class="mb-7 text-white"><?= $banner_group->content ?></p>
                    <a href="<?= $banner_group->button_url1 ?>"
                       class="btn btn-link btn-white btn-underline"><?= $banner_group->button_label1 ?>
                        <?= $banner_group->button_label1 != null ? '<i class="fas fa-angle-right"></i>' : '' ?>
                    </a>
                    <a href="<?= $banner_group->button_url2 ?>"
                       class="btn btn-link btn-white btn-underline"><?= $banner_group->button_label2 ?>
                        <?= $banner_group->button_label2 != null ? '<i class="fas fa-angle-right"></i>' : '' ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
