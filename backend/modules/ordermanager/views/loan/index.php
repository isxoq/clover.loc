<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\ordermanager\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Loans');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'cols' => [
        'id',
//        'user_id',
        'first_name',
        'last_name',
        'first_payment',
        'card_number',
        'month',
        //'card_expiry',
        //'card_phone',
        //'loan_price',
        //'created_date',
        //'status',
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
    