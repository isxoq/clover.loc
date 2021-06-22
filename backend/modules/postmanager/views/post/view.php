<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\postmanager\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'title',
        'short_description',
        'content',
        'status:status',
        [
            'attribute' => 'largeImage',
            'format' => ['image', ['width' => '150px']],
        ],
        [
            'attribute' => 'smallImage',
            'format' => ['image', ['width' => '150px']],
        ],
        'category.name',
        'published_at:datetime',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>