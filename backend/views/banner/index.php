<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
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
//        'id',
        'title',
        'urlName',
        [
            'attribute' => 'imageUrl',
            'label' => Yii::t('app','Image'),
            'format' => ['image',['width'=>'60px']]
        ],
        [
            'attribute' => 'status',
            'format' => 'status',
            'filter' => [
                '0' => Yii::t('site','Inactive'),
                '1' => Yii::t('site','Active')
            ]
        ],
        'is_right:boolean',
        'actionColumn' => [
            'dropdown'=>false,
        ],
    ],
]); ?>
    