<?php


/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t("app", 'Our blog');

if (Yii::$app->controller->route == 'post/search'){

    $this->title = Yii::t('app','Search results').": ".$dataProvider->totalCount;

    $this->params['breadcrumbs'][] =['label' => Yii::t("app", 'Our blog'), 'url' => ['all'] ];
    $this->params['breadcrumbs'][] = $this->title;


}else{
    $this->params['breadcrumbs'][] = $this->title;
}

?>


<div class="page-content with-sidebar">
    <div class="container">
        <div class="row gutter-lg">
            <div class="col-lg-9">
                <?= $this->render('_posts', ['dataProvider' => $dataProvider]) ?>
            </div>
            <aside class="col-lg-3 right-sidebar sidebar-fixed sticky-sidebar-wrapper">
                <?= $this->render('_sidebar') ?>
            </aside>
        </div>
    </div>
</div>