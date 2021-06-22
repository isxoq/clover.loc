<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\postmanager\models\PostCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= \soft\widget\bs4\DetailView::widget([
        'model' => $model,
        'panel' => $this->isAjax ? false : [],
        'attributes' => [
//              'id',
              'name',
              'status:status',
//              'created_at',
//              'updated_at',
        ],
    ]) ?>