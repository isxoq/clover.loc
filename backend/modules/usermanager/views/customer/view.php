<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\usermanager\models\Customer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'id',
//        'username',
//        'auth_key',
//        'password_hash',
//        'password_reset_token',
//        'email',
        'first_name',
        'last_name',
        'phone',
        'address',
        'status',
        'created_at',
        'updated_at',
//        'code',
//        'verify_time',
//        'wish_list',
        'family',
        'work',
        'profession',
        'experience',
        'salary',
        'passport_front',
        'passport_back',
        'passport_with_person',
        'card_number',
        'card_expiry',
        'card_phone',
    ],
]) ?>