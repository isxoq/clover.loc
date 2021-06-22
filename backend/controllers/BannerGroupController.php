<?php

namespace backend\controllers;

use Yii;
use backend\models\BannerGroup;
use backend\models\search\BannerGroupSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BannerGroupController extends AjaxCrudController
{
    
    public $modelClass = 'backend\models\BannerGroup';

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
        $searchModel = new BannerGroupSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new BannerGroup();
        return $this->ajaxCrud->createAction($model);
    }

}
