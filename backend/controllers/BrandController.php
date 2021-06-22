<?php

namespace backend\controllers;

use Yii;
use backend\models\Brand;
use backend\models\search\BrandSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BrandController extends AjaxCrudController
{
    
    public $modelClass = 'backend\models\Brand';

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
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Brand();
        return $this->ajaxCrud->createAction($model);
    }

}
