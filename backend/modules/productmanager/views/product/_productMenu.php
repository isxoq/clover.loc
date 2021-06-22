<?php

/* @var $this \soft\web\View */
/* @var $model \backend\modules\productmanager\models\Product */

?>

<?= \soft\widget\bs4\TabMenu::widget([
    'items' => [
        [
            'label' => "Asosiy ma'lumotlar",
            'url' => ['product/view', 'id' => $model->id],
        ],
        [
            'label' => "Xarakteristikalar",
            'url' => ['product/characters', 'id' => $model->id],
            'badge' => $model->charactersCount,
        ],
        [
            'label' => t('Images'),
            'url' => ['product/edit-images', 'id' => $model->id],
            'badge' => $model->getGalleryImages()->count(),
        ],
    ]
]) ?>
