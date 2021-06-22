<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */


/* @var $this soft\web\View */
/* @var $model backend\models\RecommendedCategory */

$this->title = Yii::t('site', 'Create a new');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recommended categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>