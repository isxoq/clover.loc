<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\ordermanager\models\TownSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Towns');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
    <?= \soft\grid\GridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 
        'cols' => [
                    'id',
            'slug',
            'status',
            'delivery_price',
            'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
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
    