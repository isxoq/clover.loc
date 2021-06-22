<?php

namespace backend\modules\usermanager\controllers;

use backend\modules\usermanager\models\User;
use soft\helpers\ArrayHelper;
use Yii;
use backend\modules\usermanager\models\Customer;
use backend\modules\usermanager\models\CustomerSearch;
use soft\web\AjaxCrudController;
use yii\base\BaseObject;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CustomerController extends AjaxCrudController
{

    public $modelClass = 'backend\modules\usermanager\models\Customer';

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
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $params = [];
        $viewParams = [];
        $request = Yii::$app->request;
        $model = new Customer(['scenario' => Customer::SCENARIO_CREATE]);
        $model->type = \common\models\User::CUSTOMER;
        if ($this->isAjax) {

            if ($model->load($request->post())) {
                if ($model->validate()) {
                    $model->username = Yii::$app->help->clearPhoneNumber($model->phone);
                    $model->phone = Yii::$app->help->clearPhoneNumber($model->phone);
                    $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                    $model->auth_key = Yii::$app->security->generateRandomString();
                    if ($model->save()) {
                        $forceClose = true;
                        if ($forceClose) {
                            return $this->ajaxCrud->closeModal();
                        } else {
                            return $this->ajaxCrud->viewAction($model, ['footer' => $this->ajaxCrud->afterCreateFooter(), 'forceReload' => '#crud-datatable-pjax']);
                        }
                    }
                }

            }
            return $this->ajaxCrud->createModal($model, $params, $viewParams);

        } else {

            if ($model->load($request->post()) && $model->save()) {
                if (isset($params['returnUrl'])) {
                    $returnUrl = $params['returnUrl'];
                } else {
                    $returnUrl = ['view', 'id' => $model->id];
                }
                return $this->redirect($returnUrl);
            }

            $view = ArrayHelper::getValue($params, 'view', 'create');
            $viewParams['model'] = $model;
            return $this->render($view, $viewParams);
        }
    }

    public function actionUpdate($id)
    {
        $params = [];
        $viewParams = [];
        $request = Yii::$app->request;
        $model = Customer::findOne(['id' => $id]);
        $model->scenario = Customer::SCENARIO_UPDATE;
        if (!$model) {
            not_found();
        }
        if ($this->isAjax) {

            if ($model->load($request->post())) {
                if ($model->validate()) {
                    $model->username = Yii::$app->help->clearPhoneNumber($model->phone);
                    $model->phone = Yii::$app->help->clearPhoneNumber($model->phone);

                    if ($model->password) {
                        $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                    }

                    if ($model->save()) {
                        $forceClose = true;
                        if ($forceClose) {
                            return $this->ajaxCrud->closeModal();
                        } else {
                            return $this->ajaxCrud->viewAction($model, ['footer' => $this->ajaxCrud->afterCreateFooter(), 'forceReload' => '#crud-datatable-pjax']);
                        }
                    }
                }

            }
            return $this->ajaxCrud->createModal($model, $params, $viewParams);

        } else {

            if ($model->load($request->post()) && $model->save()) {
                if (isset($params['returnUrl'])) {
                    $returnUrl = $params['returnUrl'];
                } else {
                    $returnUrl = ['view', 'id' => $model->id];
                }
                return $this->redirect($returnUrl);
            }

            $view = ArrayHelper::getValue($params, 'view', 'create');
            $viewParams['model'] = $model;
            return $this->render($view, $viewParams);
        }
    }


}
