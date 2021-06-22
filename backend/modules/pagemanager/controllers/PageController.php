<?php

namespace backend\modules\pagemanager\controllers;

use backend\modules\pagemanager\models\Page;
use backend\modules\pagemanager\models\PageSearch;
use soft\web\CrudController;

class PageController extends CrudController
{
    
    public $modelClass = 'backend\modules\pagemanager\models\Page';


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
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Page();
        if ($model->loadSave()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function findModel($id)
    {
        return Page::findModel($id);
    }

}
