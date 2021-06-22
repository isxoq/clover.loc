<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\search\RecommendedCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Recommended categories');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'toolbarButtons' => [
        'create' => [
            'modal' => false
        ],
        'update' => [
            'modal' => false
        ],
        'view' => [
            'modal' => false
        ],
    ],
    'cols' => [
        'text1',
        'category.title',
        [
            'attribute' => 'image',
            'value' => function ($data) {
                return $data->getImageUrl('preview');
            },
            'label' => Yii::t('app', 'Image'),
            'format' => ['image', ['width' => '90px', 'height' => '90px']]
        ],
        [
            'attribute' => 'status',
            'format' => 'status',
            'filter' => [
                '0' => Yii::t('site', 'Inactive'),
                '1' => Yii::t('site', 'Active')
            ]
        ],
        'actionColumn' => [
            'dropdown' => false
        ],
    ],
]); ?>
    