<?php

namespace backend\controllers;

use Yii;
use backend\models\FaqType;
use backend\models\search\FaqTypeSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class FaqTypeController extends AjaxCrudController
{
    
    public $modelClass = 'backend\models\FaqType';

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
        $searchModel = new FaqTypeSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new FaqType();
        return $this->ajaxCrud->createAction($model);
    }

}
