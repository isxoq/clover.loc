<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Brands');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'cols' => [
//        'id',
        'name',
        [
            'attribute' => 'imageUrl',
            'label' => Yii::t('app','Image'),
            'format' => ['image',['width'=>'90px']]
        ],
        [
            'attribute' => 'status',
            'format' => 'status',
            'filter' => [
                '0' => Yii::t('site','Inactive'),
                '1' => Yii::t('site','Active')
            ]
        ],
        'actionColumn' => [
            'viewOptions' => [
                'role' => 'modal-remote',
            ],
            'updateOptions' => [
                'role' => 'modal-remote',
            ],
        ],
    ],
]); ?>
    