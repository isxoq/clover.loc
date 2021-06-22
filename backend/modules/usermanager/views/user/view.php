<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\usermanager\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'id',
        'username',
        'email',
        'first_name',
        'last_name',
        'phone',
        'address',
        'status',
    ],
]) ?>