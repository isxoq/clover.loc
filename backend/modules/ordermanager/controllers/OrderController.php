<?php

namespace backend\modules\ordermanager\controllers;

use Yii;
use backend\modules\ordermanager\models\Order;
use backend\modules\ordermanager\models\search\OrderSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OrderController extends AjaxCrudController
{
    
    public $modelClass = 'backend\modules\ordermanager\models\Order';

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
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Order();
        return $this->ajaxCrud->createAction($model);
    }

}
