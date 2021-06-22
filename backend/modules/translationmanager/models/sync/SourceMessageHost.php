<?php

namespace backend\modules\translationmanager\models\sync;

use Yii;

/**
 * Class SourceMessageHost
 * @property int $id [int(11)]
 * @property string $category [varchar(255)]
 * @property string $message
 * @property int $created_at [int(11)]
 * @property-read mixed $messages
 * @property int $updated_at [int(11)]
 */
class SourceMessageHost extends \soft\db\ActiveRecord
{
    public static function tableName()
    {
        return 'source_message';
    }

    public static function getDb()
    {
        return Yii::$app->db2;
    }

    public function getMessages()
    {
        return $this->hasMany(MessageHost::className(), ['id' => 'id']);
    }

    /**
     * Oxirgi import qilingandan keyin hostingdagi bazaga qo'shilgan yangi tarjimalar
     * @return array|SourceMessageHost[]
     */
    public static function newSourceMessagesOnHost()
    {
        return  static::find()->andWhere(['>', 'id', 820])->all();
        $lastImportedTime = MessageCategoryLocal::lastImportedTime();
        return  static::find()->andWhere(['>=', 'created_at', $lastImportedTime])->all();
    }


}