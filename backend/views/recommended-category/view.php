<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */


/* @var $this soft\web\View */
/* @var $model backend\models\RecommendedCategory */

$this->title = $model->text1;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recommended categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'text1',
        'text2',
        'text3',
        'category.title',
        [
            'attribute' => 'image',
            'value' => $model->getImageUrl('preview'),
            'label' => Yii::t('app', 'Image'),
            'format' => ['image', ['width' => '90px', 'height' => '90px']]
        ],
        'button_label',
        'url',
        'status:status',
    ],
]) ?>