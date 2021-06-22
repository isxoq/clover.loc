<?php


/* @var $this soft\web\View */
/* @var $model backend\models\FaqType */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faq Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
//              'id',
        'name',
        'status',
        'created_at',
    ],
]) ?>