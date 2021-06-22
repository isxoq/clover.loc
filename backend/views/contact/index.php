<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\search\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
    <?= \soft\grid\GridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'toolbarButtons' => [
            'create' => false
        ],
        'cols' => [
//            'id',
            'name',
//            'title',
//            'text:ntext',
            'phone',
            //'email:email',
            [
                'attribute' => 'status',
                'format' => 'status',
                'filter' => [
                    '0' => Yii::t('site', 'Inactive'),
                    '1' => Yii::t('site', 'Active')
                ]
            ],
            'created_at',
            'actionColumn' => [
                'dropdown'=>false,
                'template' => '{view} {delete}',

            ],
        ],
        ]); ?>
    