<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\ordermanager\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
              'id', 
              'user_id', 
              'phone', 
              'payment_type', 
              'status', 
              'created_at', 
              'updated_at', 
        ],
    ]) ?>