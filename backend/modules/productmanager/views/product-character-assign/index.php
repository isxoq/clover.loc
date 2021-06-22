<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\ProductCharacterAssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Character Assigns';
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
    <?= \soft\grid\GridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 
        'cols' => [
                    'id',
            'sort_order',
            'character_id',
            'product_id',
            'status',
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
    