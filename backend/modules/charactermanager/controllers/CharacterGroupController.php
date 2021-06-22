<?php

namespace backend\modules\charactermanager\controllers;

use Yii;
use backend\modules\charactermanager\models\CharacterGroup;
use backend\modules\charactermanager\models\search\CharacterGroupSearch;
use soft\web\SoftController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CharacterGroupController extends SoftController
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
        $searchModel = new CharacterGroupSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->ajaxCrud->viewAction($model);
    }

    public function actionCreate()
    {
        $model = new CharacterGroup();
        return $this->ajaxCrud->createAction($model);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->ajaxCrud->updateAction($model);
    }

    public function actionDelete($id)
    {
        $this->checkIfRequestMethodIsPost();
        $this->findModel($id)->delete();
        return $this->ajaxCrud->closeModalResponse();
    }

    public function actionBulkdelete()
    {
        $this->checkIfRequestMethodIsPost();
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        return $this->ajaxCrud->closeModalResponse();
    }

    /**
     * Finds a single model for crud actions
     * @param $id
     * @return CharacterGroup
     * @throws yii\web\NotFoundHttpException
     */
    public function findModel($id)
    {
        /** @var CharacterGroup $model */
        $model = CharacterGroup::find()->andWhere(['id' => $id])->one();
        if ($model == null) {
            not_found();
        }
        return $model;
    }

}
