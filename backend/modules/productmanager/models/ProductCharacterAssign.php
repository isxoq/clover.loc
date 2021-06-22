<?php

namespace backend\modules\productmanager\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use Yii;
use backend\modules\charactermanager\models\Character;

/**
 * This is the model class for table "product_character_assign".
 *
 * @property int $id
 * @property int|null $sort_order
 * @property int|null $character_id
 * @property int|null $product_id
 * @property int|null $status
 * @property int|null $value
 *
 * @property Character $character
 * @property Product $product
 */
class   ProductCharacterAssign extends \soft\db\ActiveRecord
{

    public $multilingualAttributes = ['value'];

    public static function tableName()
    {
        return 'product_character_assign';
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::class,
                'attributes' => ['value'],
                'languages' => Yii::$app->params['languages'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['value', 'string', 'max' => 255],
            [['value', 'character_id'], 'required'],
            [['sort_order', 'character_id', 'product_id', 'status'], 'integer'],
            ['character_id', 'unique', 'targetAttribute' => ['character_id', 'product_id'], 'message' => "Ushbu xarakteristika avvalroq biriktirilgan"],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function setAttributeLabels()
    {
        return [
            'sort_order' => 'Sort Order',
            'character_id' => 'Xarakteristika',
            'product_id' => 'Mahsulot',
            'value' => "Qiymat",
        ];
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public static function find()
    {
        return parent::find()->multilingual()->orderBy(['sort_order' => SORT_ASC]);
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * @return \soft\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}
