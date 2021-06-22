<?php

/* @var $this soft\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('_productMenu', ['model' => $model]) ?>

<?= \soft\widget\bs4\DetailView::widget([
    'model' => $model,
    'panel' => $this->isAjax ? false : [],
    'attributes' => [
        'id',
        'name_uz',
        'name_ru',
        'price:sum',
        'loan_price:sum',
        'old_price:sum',
        'order_count',
        'category.title',
        [
            'attribute' => 'brand.name',
            'label'=>'Brand nomi',
        ],
        'status:status',
        'meta_title_uz',
        'meta_title_ru',
        'meta_description_uz',
        'meta_description_ru',
        'meta_keywords_uz',
        'meta_keywords_ru',
        'description_uz:html',
        'description_ru:html',
        'created_at:dateTimeUz',
        'updated_at:dateTimeUz',
    ],
]) ?>