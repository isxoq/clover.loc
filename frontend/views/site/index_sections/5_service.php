<?php

use backend\models\Service;

$sercives = Service::find()
    ->where(['status'=>1])
    ->all();

?>
<section class="container appear-animate">
    <div class="service-list">
        <div class="owl-carousel owl-theme owl-middle row cols-lg-4 cols-md-3 cols-sm-2 cols-2"
             data-owl-options="{
                            'items': 4,
                            'margin': 20,
                            'dots': false,
                            'autoplay': true,
                            'responsive': {
                                '0': {
                                    'items': 1
                                },
                                '576': {
                                    'items': 2
                                },
                                '768': {
                                    'items': 3
                                },
                                '992': {
                                    'items': 4
                                }
                            }
                        }">
            <?php foreach ($sercives as $key=>$sercive):?>
            <div class="icon-box text-center appear-animate" data-animation-options="{
                            'name':'zoomInLeft',
                            'delay': '.<?= intval($key)+2?>s'
                        }">
                <i class="icon-box-icon <?=$sercive->icon?>" style="font-size: 4.4rem;"></i>
                <div class="icon-box-content">
                    <h4 class="icon-box-title"><?=$sercive->title?></h4>
                    <p><?=$sercive->content?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</section>