<?php

use backend\modules\productmanager\models\Category;
use soft\helpers\Html;
use backend\modules\productmanager\models\Product;
use kartik\tree\TreeViewInput;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahsulotlar';
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();

$this->registerCss("
    
    .kv-tree li {
        line-height: normal;
        font-size: 14px;
    }

");
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'toolbarButtons' => [
        'create' => [
            'modal' => false,
        ]
    ],
    'cols' => [
        [
            'attribute' => 'productName',
            'format' => 'raw',
            'value' => function ($model) {
                /** @var Product $model */
                return $model->name;
            }
        ],
        'price:sum',
        'loan_price:sum',
        [
//            'attribute' => 'category_id',
//            'filterType' => \kartik\tree\TreeViewInput::class,
//            'width' => '30%',
            'label' => 'Kategoriya',
            'value' => function ($model) {
                /** @var Product $model */
                return $model->category->title ?? '';
            },
        ],
        [
            'attribute' => 'status',
            'format' => 'status',
            'filter' => [
                '0' => Yii::t('site', 'Inactive'),
                '1' => Yii::t('site', 'Active')
            ]
        ],
        //'created_at',
        //'updated_at',
        'actionColumn' => [
            'dropdown' => false,
            'template' => '{view} {update} {edit-images} {delete}',
            'buttons' => [
                'edit-images' => function ($url, $model) {

                    return a('', $url, ['title' => 'Rasmlar', 'data-toggle' => 'tooltip', 'data-pjax' => 0], 'images');
                }
            ]
        ],
    ],
]); ?>
    