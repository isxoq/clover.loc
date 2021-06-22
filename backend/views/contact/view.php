<?php


/* @var $this soft\web\View */
/* @var $model backend\models\Contact */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
//              'id',
              'name', 
              'title', 
              'text', 
              'phone', 
              'email', 
              'status', 
              'created_at', 
        ],
    ]) ?>