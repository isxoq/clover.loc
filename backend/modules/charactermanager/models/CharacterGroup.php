<?php

namespace backend\modules\charactermanager\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;

/**
 * This is the model class for table "character_group".
 *
 * @property int $id
 * @property int|null $sort_order
 * @property int|null $status
 * @property string $name
 *
 * @property-read int $charactersCount
 * @property Character[] $characters
 */
class CharacterGroup extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'character_group';
    }

    public function rules()
    {
        return [
            ['name', 'string', 'max' => 255],
            ['name', 'required'],
            [['sort_order', 'status'], 'integer'],
        ];
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['name'],
                'languages' => $this->languages(),
            ],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'charactersCount' => "Xarakteristikalar soni",
        ];
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }

    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['group_id' => 'id']);
    }

    public function getCharactersCount()
    {
        return intval($this->getCharacters()->count());
    }

}
