<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\ordermanager\models\Town */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Towns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
              'id', 
              'slug', 
              'status', 
              'delivery_price', 
              'created_at', 
              'updated_at', 
              'created_by', 
              'updated_by', 
        ],
    ]) ?>