<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\charactermanager\models\CharacterGroup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Character Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
              'id', 
              'sort_order', 
              'status', 
        ],
    ]) ?>