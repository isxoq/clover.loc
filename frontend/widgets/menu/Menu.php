<?php

namespace frontend\widgets\menu;

//use common\models\Menyular;
use yii\base\Widget;
use yii;
use yii\helpers\Url;

class Menu extends Widget
{

    public $mainCategories;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $menus = "<ul class='nav navbar-nav'>";
        $menus .= $this->generate_multilevel_menus() . "</ul>";
        return $menus;
    }

    public function generate_multilevel_menus($parent = NULL)
    {
        $menu = "";
        if (is_null($parent)) {
            $menu1 = $this->mainCategories;
        } else {
            $menu1 = $parent->activeSubCategories;
        }
        // if (empty($menu1)) {
        //     return $menu;
        // }
        foreach ($menu1 as $m) {
            if ($m->activeSubCategories) {
                $menu .= "<li><a href={}>{$m->title}</a>";
            } else {
                $menu .= "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><?= $category->title ?><span
    class='caret'></span></a>";
            }
            $menu .= '<ul>' . $this->generate_multilevel_menus($m) . "</ul>";
            $menu .= '</li>';
        }
        return $menu;
    }

    public function generateRoute($model)
    {
        if ($model->sahifa_id != null) {
            return Url::to(['page/view', 'id' => $model->sahifa_id]);
        } elseif ($model->category_id != null) {
            return Url::to(['categories/view', 'id' => $model->category_id]);
        } else {
            return Url::to([$model->route]);
        }
    }
}