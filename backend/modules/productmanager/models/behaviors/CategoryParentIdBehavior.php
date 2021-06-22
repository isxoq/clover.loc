<?php

namespace backend\modules\productmanager\models\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;


class CategoryParentIdBehavior extends Behavior
{

    /**
     * @var \backend\modules\productmanager\models\Category
     */
    public $owner;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'parentId',
            ActiveRecord::EVENT_AFTER_UPDATE => 'parentId',
        ];
    }

    public function parentId()
    {

        $category = CategoryModel::findOne($this->owner->id);
        $parent = $category->parent;
        if ($parent != null) {
            $category->parent_id = $parent->id;
            $category->save(false);
        }

    }
}