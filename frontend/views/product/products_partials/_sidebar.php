<?php

use frontend\models\Category;
use soft\helpers\Url;

/* @var $this \soft\web\View */
/* @var $minPriceFromAll int */
/* @var $maxPriceFromAll int */

$categories = Category::activeMainCategories();

$minPrice = Yii::$app->request->get('min-price', $minPriceFromAll);
$maxPrice = Yii::$app->request->get('max-price', $maxPriceFromAll);

$this->registerCss('
    .filter-area input{
        -webkit-appearance: auto;
    }
');

?>

    <div class="sidebar-overlay">
        <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
    </div>
    <div class="sidebar-content mb-3 filter-area">
        <div class="sticky-sidebar">

            <div class="widget widget-collapsible">
                <h3 class="widget-title">Price</h3>
                <div class="widget-body">
                    <form action="<?= Url::current() ?>" method="get">

                        <div id="filter-price-range-slider"></div>

                        <div class="filter-actions">
                            <div class="filter-price-text mb-4">
                                <b id="filter-price-range-text"></b>
                            </div>

                            <input type="hidden" name="min-price" id="min-price-input" value="<?= $minPrice ?>">
                            <input type="hidden" name="max-price" id="max-price-input" value="<?= $maxPrice ?>">
                        </div>
                </div>
            </div>

            <?php foreach ($category->attributeGroups as $group): ?>
                <?php foreach ($group->characters as $character): ?>
                    <?php
                    $values = $category->getAttributeValues()
                        ->andWhere(['character_id' => $character->id])
                        ->indexBy('text')
                        ->distinct()
                        ->all();
                    ?>
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title"><?= $character->name ?></h3>
                        <ul class="widget-body filter-items">
                            <?php foreach ($values as $value): ?>
                                <li> <?= \yii\helpers\Html::checkbox("filter[]", in_array($value->value, $attributeValues), [
                                            'value' => $value->value,
                                            'label' => $value->value
                                        ]
                                    ) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>


                <?php endforeach ?>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary"><?= t('Filter') ?></button>
            </form>
        </div>
    </div>

<?php


//$this->registerJs('')

$jsText = <<<JS

 var slider = document.getElementById('filter-price-range-slider');

    noUiSlider.create(slider, {
        start: [{minPrice}, {maxPrice}],
        connect: true,
        step: 5000,
        range: {
            'min': {minPriceFromAll},
            'max': {maxPriceFromAll}
        }
    });


    slider.noUiSlider.on('update', function (values, handle) {

        var minPrice = parseInt(values[0])
        var maxPrice = parseInt(values[1])
        var priceText = number_format(minPrice) + " {currencCode} - " + number_format(maxPrice) + " {currencCode}"
        $('#filter-price-range-text').text(priceText)
        $('input#min-price-input').val(minPrice)
        $('input#max-price-input').val(maxPrice)

    });

JS;

$js = strtr($jsText, [

    '{minPrice}' => $minPrice,
    '{maxPrice}' => $maxPrice,
    '{minPriceFromAll}' => $minPriceFromAll,
    '{maxPriceFromAll}' => $maxPriceFromAll,
    '{currencCode}' => "so'm",

]);

$this->registerJs($js);
?>