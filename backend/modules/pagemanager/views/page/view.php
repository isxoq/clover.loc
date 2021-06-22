<?php
/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 15:03
 */


/* @var $this soft\web\View */
/* @var $model backend\modules\pagemanager\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sahifalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
//              'id',
              'title',
              'content:html',
              'slug',
              'created_at', 
              'updated_at', 
              'image', 
              'status', 
        ],
    ]) ?>