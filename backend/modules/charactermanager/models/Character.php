<?php

namespace backend\modules\charactermanager\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;

/**
 * This is the model class for table "character".
 *
 * @property int $id
 * @property int|null $sort_order
 * @property int|null $group_id
 * @property int|null $status
 *
 * @property CharacterGroup $group
 */
class Character extends \soft\db\ActiveRecord
{

    public static function tableName()
    {
        return 'character';
    }

    public function rules()
    {
        return [
            ['name', 'string', 'max' => 255],
            ['name', 'required'],
            [['sort_order', 'group_id', 'status'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
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
            'group_id' => 'Guruh',
            'group.name' => 'Guruh',
        ];
    }

    public static function find()
    {
        return parent::find()->multilingual();
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CharacterGroup::className(), ['id' => 'group_id']);
    }



}
