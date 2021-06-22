<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * Class GalleryImage
 * @package backend\models
 * @property $id int
 * @property string $type [varchar(255)]
 * @property string $ownerId [varchar(255)]
 * @property int $rank [int(11)]
 * @property string $name [varchar(255)]
 * @property string $description
 */
class GalleryImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'gallery_image';
    }

}