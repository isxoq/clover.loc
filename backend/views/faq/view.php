<?php


/* @var $this soft\web\View */
/* @var $model backend\models\Faq */

$this->title = $model->question;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
//              'id',
        'question',
       [
           'attribute'=> 'asked',
           'format' => 'raw',
       ],
        'status:status',
        'faqType.name',
//              'created_at',
//              'updated_at',
    ],
]) ?>