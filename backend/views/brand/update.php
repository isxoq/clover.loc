<?php

use yii\helpers\Html;

/* @var $this soft\web\View */
/* @var $model backend\models\Brand */

$this->title = Yii::t('site', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

