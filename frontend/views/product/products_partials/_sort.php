<?php

use soft\helpers\Url;
use soft\helpers\Html;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$currentPerPage = Yii::$app->request->get('per-page', 12);
$currentSort = Yii::$app->request->get('sort');

$sortOptions = [
    'name' => t('Sort by name'),
    '-name' => t('Sort by name in reverse order'),
    'latest' => t('New products'),
    'price-low' => t('Price to low'),
    'price-high' => t('Price to high'),
];

$perPageOptions = [
    12 => 12,
    24 => 24,
    36 => 36,
]


?>

    <nav class="toolbox sticky-toolbox sticky-content fix-top">
        <div class="toolbox-left">
            <a href="#"
               class="toolbox-item left-sidebar-toggle btn btn-sm btn-outline btn-primary d-lg-none">Filters<i
                        class="d-icon-arrow-right"></i></a>
            <div class="toolbox-item toolbox-sort select-box">
                <label>Sort By :</label>

                <?= Html::dropDownList('sort', $currentSort, $sortOptions, [
                    'class' => 'form-control select-sorter',
                    'prompt' => t('Default sort')
                ]) ?>

            </div>
        </div>
        <div class="toolbox-right">
            <div class="toolbox-item toolbox-show select-box">
                <label>Show :</label>
                <?= Html::dropDownList('per-page', $currentPerPage, $perPageOptions, [
                    'class' => 'form-control select-sorter',
                    'prompt' => t('Default sort')
                ]) ?>
            </div>
        </div>
    </nav>

<?php

$js = <<<JS
    
        $('.select-sorter').on('change', function(){
           $('form#filer-and-sort-form').submit()
        })

JS;
$this->registerJs($js);


?>