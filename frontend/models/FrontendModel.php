<?php


namespace frontend\models;

use frontend\models\Category;
use Yii;

class FrontendModel
{

    public static function activeMainCategoriesForHeaderMenu($withSubCategories = false)
    {

        $selectAttributes = 'id,status,parent_id,root,lft,slug,icon_type,icon';
        $query = Category::findMainCategories()
            ->andWhere(['status' => 1])
            ->select($selectAttributes)
            ->with('translation')
            ->asArray()
        ;

        $with = ['translation'];
        $query->with = $with;

        if ($withSubCategories) {
            $query->with(['activeSubCategories' => function($query) use ($selectAttributes) {
                $with = ['translation'];
                $query->with = $with;
                return $query->select($selectAttributes);
            }]);
        }

        return Yii::$app->db->cache(function () use ($query) {
            return $query->all();
        });
    }

    public static function renderCategoryIcon($icon_type, $icon)
    {
        if (empty($icon)){
            return '<i class="d-icon-shoppingbag"></i>';
        }
        if ($icon_type == Category::ICON_TYPE_RIODE){
            return "<i class='$icon'></i>";
        }
        if ($icon_type == Category::ICON_TYPE_FA){
            return "<i class='fas fa-$icon'></i>";
        }
        return '<i class="d-icon-shoppingbag"></i>';
    }
}