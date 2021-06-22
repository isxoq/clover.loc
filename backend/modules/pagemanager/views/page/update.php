<?php
/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 15:01
 */

use yii\helpers\Html;

/* @var $this soft\web\View */
/* @var $model backend\modules\pagemanager\models\Page */

$this->title = Yii::t('site', 'Update');
$this->params['breadcrumbs'][] = ['label' => 'Sahifalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

