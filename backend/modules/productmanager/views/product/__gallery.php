<?php

use soft\widget\bs4\galleryManager\GalleryManager;


?>
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
