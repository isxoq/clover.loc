<?php

namespace backend\modules\translationmanager\models\sync;

/**
 * Class MessageCategoryHost
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property int $exported_at [int(11)]
 * @property int $imported_at [int(11)]
 */
class MessageCategoryLocal extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'message_category';
    }

    /**
     * @return MessageCategoryLocal|null
     */
    public static function getApp()
    {
        return static::findOne(['name' => 'app']);
    }

    public static function lastExportedTime()
    {
        $app = static::getApp();
        return $app->exported_at;

    }

    public static function updateExportedTime()
    {
        $app = static::getApp();
        $app->exported_at = time();
        return $app->save(false);
    }

    public static function lastImportedTime()
    {
        $app = static::getApp();
        return $app->imported_at;

    }

    public static function updateImportedTime()
    {
        $app = static::getApp();
        $app->imported_at = time();
        return $app->save(false);
    }




}