<?php


/* @var $this soft\web\View */
/* @var $model backend\modules\charactermanager\models\CharacterGroup */

$this->title = Yii::t('site', 'Create a new');
$this->params['breadcrumbs'][] = ['label' => 'Character Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>