<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\charactermanager\models\Character */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Characters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
              'id', 
              'sort_order', 
              'group_id', 
              'status', 
        ],
    ]) ?>