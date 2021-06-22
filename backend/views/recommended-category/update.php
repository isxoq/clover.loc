<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */

use yii\helpers\Html;

/* @var $this soft\web\View */
/* @var $model backend\models\RecommendedCategory */

$this->title = Yii::t('site', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recommended categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

