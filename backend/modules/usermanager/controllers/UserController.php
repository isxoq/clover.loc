<?php

namespace backend\modules\usermanager\controllers;

use Yii;
use backend\modules\usermanager\models\User;
use backend\modules\usermanager\models\UserSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UserController extends AjaxCrudController
{
    
    public $modelClass = 'backend\modules\usermanager\models\User';

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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        return $this->ajaxCrud->createAction($model);
    }

}
