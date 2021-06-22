<?php

namespace backend\modules\productmanager\controllers;

use backend\modules\productmanager\models\behaviors\CategorySortBehavior;
use backend\modules\productmanager\models\Category;
use Yii;
use soft\web\SoftController;

class CategoryController extends SoftController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSort()
    {


        $cat = Category::find()->one();
        dd($cat->behaviors);

    }
}