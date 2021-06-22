<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\usermanager\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'cols' => [
        'id',
        'username',
        //'email:email',
        //'created_at',
        //'updated_at',
        'first_name',
        'last_name',
        'phone',
        'address',
        'status',
//        'type',
//        'password_hash',
        //'code',
        //'verify_time:datetime',
        //'wish_list:ntext',
        //'family',
        //'work',
        //'profession',
        //'experience',
        //'salary',
        //'passport_front',
        //'passport_back',
        //'passport_with_person',
        //'card_number',
        //'card_expiry',
        //'card_phone',
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
    