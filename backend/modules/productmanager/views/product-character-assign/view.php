<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\productmanager\models\ProductCharacterAssign */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Character Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
              'id', 
              'sort_order', 
              'character_id', 
              'product_id', 
              'status', 
        ],
    ]) ?>