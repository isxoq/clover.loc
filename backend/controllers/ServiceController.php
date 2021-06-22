<?php

namespace backend\controllers;

use Yii;
use backend\models\Service;
use backend\models\search\ServiceSearch;
use soft\web\AjaxCrudController;

class ServiceController extends AjaxCrudController
{
    

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
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Service();
        return $this->ajaxCrud->createAction($model);
    }

}
