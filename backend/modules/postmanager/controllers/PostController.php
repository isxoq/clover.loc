<?php

namespace backend\modules\postmanager\controllers;

use soft\web\CrudController;
use soft\web\SoftController;
use backend\modules\postmanager\models\Post;
use backend\modules\postmanager\models\search\PostSearch;
use Yii;

class PostController extends CrudController
{

    public $modelClass = 'backend\modules\postmanager\models\Post';


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
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Post();
        $request = Yii::$app->request;
        if ($model->load($request->post())) {

            if (empty($model->publishedAtField)) {
                $model->published_at = null;
            } else {

                $model->published_at = strtotime($model->publishedAtField);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Post::findModel($id);

        $request = Yii::$app->request;
        if ($model->load($request->post())) {

            if (empty($model->publishedAtField)) {
                $model->published_at = null;
            } else {

                $model->published_at = strtotime($model->publishedAtField);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        $model->publishedAtField = date('Y-m-d H:i', $model->published_at);
        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function findModel($id)
    {
        return Post::findModel($id);
    }

}
