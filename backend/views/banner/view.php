<?php


/* @var $this soft\web\View */
/* @var $model backend\models\Banner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'title',
        'description',
        'text1',
        'text2',
        'urlName',
        [
            'attribute' => 'imageUrl',
            'label' => Yii::t('app', 'Image'),
            'format' => ['image', ['width' => '60px']]
        ],
        'status:status',
        'is_right:boolean',
        'url',


    ],
]) ?>