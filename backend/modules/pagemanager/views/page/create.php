<?php
/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 15:02
 */


/* @var $this soft\web\View */
/* @var $model backend\modules\pagemanager\models\Page */

$this->title = Yii::t('site', 'Create a new');
$this->params['breadcrumbs'][] = ['label' => 'Sahifalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>