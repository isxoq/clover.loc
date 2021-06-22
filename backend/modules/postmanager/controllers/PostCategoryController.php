<?php

namespace backend\modules\postmanager\controllers;

use Yii;
use backend\modules\postmanager\models\PostCategory;
use backend\modules\postmanager\models\search\PostCategorySearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PostCategoryController extends AjaxCrudController
{
    
    public $modelClass = 'backend\modules\postmanager\models\PostCategory';


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



    public function actionIndex()
    {
        $searchModel = new PostCategorySearch();
        $dataProvider = $searchModel->search();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new PostCategory();
        return $this->ajaxCrud->createAction($model);
    }

}
