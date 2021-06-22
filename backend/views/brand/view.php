<?php


/* @var $this soft\web\View */
/* @var $model backend\models\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//echo Yii::$app->formatter->asImage($model->imageUrl, ['width' => '200px'] );

?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
//              'id',
        'name',
        [
            'attribute' => 'imageUrl',
            'label' => Yii::t('app', 'Image'),
            'format' => ['image', ['width' => '200px']],
        ],
        'status',
    ],
]) ?>