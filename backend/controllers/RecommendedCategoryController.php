<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */

namespace backend\controllers;

use Yii;
use backend\models\RecommendedCategory;
use backend\models\search\RecommendedCategorySearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RecommendedCategoryController extends AjaxCrudController
{
    
    public $modelClass = 'backend\models\RecommendedCategory';

    /*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                ],
            ],
        ];
    }
    */


    public function actionIndex()
    {
        $searchModel = new RecommendedCategorySearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new RecommendedCategory();
        return $this->ajaxCrud->createAction($model);
    }

}
