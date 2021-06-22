<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\search\FaqTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faq Types');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
    <?= \soft\grid\GridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 
        'cols' => [
//            'id',
            'name',
            [
                'attribute' => 'status',
                'format' => 'status',
                'filter' => [
                    '0' => Yii::t('site','Inactive'),
                    '1' => Yii::t('site','Active')
                ]
            ],
//            'created_at',
//            'updated_at',
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
    