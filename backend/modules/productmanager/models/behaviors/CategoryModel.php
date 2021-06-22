<?php


namespace backend\modules\productmanager\models\behaviors;


use yii\db\ActiveRecord;

/**
 * Class CategorySortModel
 * @package backend\modules\productmanager\models\behaviors
 * @property int $id [int(11)]
 * @property int $root [int(11)]
 * @property int $lft [int(11)]
 * @property int $rgt [int(11)]
 * @property int $lvl [smallint(5)]
 * @property string $name [varchar(60)]
 * @property string $slug [varchar(255)]
 * @property bool $status [tinyint(1)]
 * @property string $icon [varchar(255)]
 * @property int $icon_type [smallint(1)]
 * @property bool $active [tinyint(1)]
 * @property bool $selected [tinyint(1)]
 * @property bool $disabled [tinyint(1)]
 * @property bool $readonly [tinyint(1)]
 * @property bool $visible [tinyint(1)]
 * @property bool $collapsed [tinyint(1)]
 * @property bool $movable_u [tinyint(1)]
 * @property bool $movable_d [tinyint(1)]
 * @property bool $movable_l [tinyint(1)]
 * @property bool $movable_r [tinyint(1)]
 * @property bool $removable [tinyint(1)]
 * @property bool $removable_all [tinyint(1)]
 * @property bool $child_allowed [tinyint(1)]
 * @property string $image [varchar(150)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property-read \backend\modules\productmanager\models\behaviors\CategoryModel $parent
 * @property int $parent_id [int(11)]
 */
class CategoryModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [];
    }

    public function behaviors()
    {
        return [];
    }

    /**
     * @return static
     */
    public function getParent()
    {
        $lvl = $this->lvl - 1;
        $rgt = $this->rgt;
        $lft = $this->lft;
        $root = $this->root;

        return static::find()
            ->where(['root' => $root, 'lvl' => $lvl])
            ->andWhere(['<', 'lft', $lft])
            ->andWhere(['>', 'rgt', $rgt])
            ->one();
    }

}