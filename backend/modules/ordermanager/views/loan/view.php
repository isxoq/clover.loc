<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\ordermanager\models\Loan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
              'id', 
              'user_id', 
              'first_name', 
              'last_name', 
              'card_number', 
              'card_expiry', 
              'card_phone', 
              'product_id', 
              'loan_price', 
              'first_payment', 
              'month', 
              'created_date', 
              'status', 
        ],
    ]) ?>