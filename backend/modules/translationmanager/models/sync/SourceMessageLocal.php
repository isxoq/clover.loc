<?php

namespace backend\modules\translationmanager\models\sync;

/**
 * Class SourceMessageLocal
 * @property int $id [int(11)]
 * @property string $category [varchar(255)]
 * @property string $message
 * @property int $created_at [int(11)]
 * @property-read MessageLocal[] $messages
 * @property int $updated_at [int(11)]
 */
class SourceMessageLocal extends \soft\db\ActiveRecord
{
    public static function tableName()
    {
        return 'source_message';
    }

    public function getMessages()
    {
        return $this->hasMany(MessageLocal::className(), ['id' => 'id']);
    }

    /**
     * Oxirgi export qilingandan keyin local bazaga qo'shilgan tarjimalar
     * @return array|SourceMessageLocal[]
     */
    public static function newSourceMessagesOnLocal()
    {

        return  static::find()->andWhere(['>', 'id', 822])->all();
        $lastExportedTime = MessageCategoryLocal::lastExportedTime();
        return  static::find()->andWhere(['>=', 'created_at', $lastExportedTime])->all();
    }

}