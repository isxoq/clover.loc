<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\usermanager\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
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
        'first_name',
        'last_name',
        'phone',
        'address',
        'status',
//        'type',
        //        'id',
//        'username',
//        'auth_key',
//        'password_hash',
//        'password_reset_token',
        //'email:email',
        //'status',
        //'created_at',
        //'updated_at',
        //'phone',
        //'first_name',
        //'last_name',
        //'address',
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
    