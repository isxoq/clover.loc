<?php

use soft\widget\bs4\galleryManager\GalleryManager;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\ProductCharacterAssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \backend\modules\productmanager\models\Product */

$this->title = t('Rasmlar');
$this->registerAjaxCrudAssets();

$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('_productMenu', ['model' => $model]) ?>



<?php
if ($model->isNewRecord) {
    echo 'Yangi yaratilayotganda rasm yuklab bo\'lmaydi';
} else {
    echo GalleryManager::widget(
        [
            'model' => $model,
            'behaviorName' => 'galleryBehavior',
            'apiRoute' => 'product/galleryApi'
        ]
    );
}
?>
