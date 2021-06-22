<?php

namespace backend\controllers;

use Yii;
use backend\models\Contact;
use backend\models\search\ContactSearch;
use soft\web\AjaxCrudController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ContactController extends AjaxCrudController
{
    
    public $modelClass = 'backend\models\Contact';

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
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Contact();
        return $this->ajaxCrud->createAction($model);
    }

}
