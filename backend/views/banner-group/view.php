<?php


/* @var $this soft\web\View */
/* @var $model backend\models\BannerGroup */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Banner Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'title',
        'content',
        [
            'attribute' => 'img',
            'value' => $model->getImageUrl('preview'),
            'label' => Yii::t('app','Image'),
            'format' => ['image',['width'=>'90px']]
        ],
        'button_label1',
        'button_url1',
        'button_label2',
        'button_url2',
        'status:status',
    ],
]) ?>