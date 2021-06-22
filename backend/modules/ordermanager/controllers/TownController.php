<?php

namespace backend\modules\ordermanager\controllers;

use Yii;
use backend\modules\ordermanager\models\Town;
use backend\modules\ordermanager\models\TownSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TownController extends AjaxCrudController
{
    
    public $modelClass = 'backend\modules\ordermanager\models\Town';

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
        $searchModel = new TownSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Town();
        return $this->ajaxCrud->createAction($model);
    }

}
