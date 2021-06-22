<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\ordermanager\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'cols' => [
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'detailRowCssClass' => '',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return \soft\grid\GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_items', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        'full_name',
        'phone',
//        'paymentMethod'=>[
//            'filter'=>[]
//        ],
        [
            'attribute' => 'payment_type',
            'filter' => \backend\modules\ordermanager\models\CheckoutForm::paymentMethods(),
            'value' => 'paymentMethod'
        ],
        [
            'attribute' => 'status',
            'filter' => \backend\modules\ordermanager\models\Order::statuses(),
            'value' => 'statusLabel'
        ],
        //'created_at',
        //'updated_at',
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
    