<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\search\BannerGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner Groups';
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
    ],
    'cols' => [
        'title',
        [
            'attribute' => 'img',
            'value' => function ($data) {
                return $data->getImageUrl('preview');
            },
            'label' => Yii::t('app', 'Image'),
            'format' => ['image', ['width' => '90px']]
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
    