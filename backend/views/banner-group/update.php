<?php

use yii\helpers\Html;

/* @var $this soft\web\View */
/* @var $model backend\models\BannerGroup */

$this->title = Yii::t('site', 'Update');
$this->params['breadcrumbs'][] = ['label' => 'Banner Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

