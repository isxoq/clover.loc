<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\productmanager\models\ProductCharacterAssign */

$this->title = Yii::t('site', 'Create a new');
$this->params['breadcrumbs'][] = ['label' => 'Product Character Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>