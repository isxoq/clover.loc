<?php

namespace backend\modules\productmanager\controllers;

use backend\modules\productmanager\models\ProductCharacterAssign;
use backend\modules\productmanager\models\search\ProductCharacterAssignSearch;
use soft\helpers\SiteHelper;
use soft\widget\dynamicform\DynamicFormModel;
use Yii;
use backend\modules\productmanager\models\Product;
use backend\modules\productmanager\models\search\ProductSearch;
use soft\web\SoftController;
use yii\base\BaseObject;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

class ProductController extends SoftController
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

    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::class,
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'product' => Product::class
                ]
            ],
        ];
    }

    //<editor-fold desc="CRUD" defaultstate="collapsed">

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
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
        $model = new Product();
        if ($model->loadSave()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \yii\db\Exception
     * @throws \Yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadSave()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
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
     * @return Product
     * @throws yii\web\NotFoundHttpException
     */
    public function findModel($id)
    {
        /** @var Product $model */
        $model = Product::find()->andWhere(['id' => $id])->one();
        if ($model == null) {
            not_found();
        }
        return $model;
    }


    //</editor-fold>


    public function actionEditImages($id)
    {
        $product = Product::findActiveOne($id);
        return $this->render('editImages', [
            'model' => $product
        ]);
    }


    //<editor-fold desc="Characters" defaultstate="collapsed">

    /**
     * Productga tegishli xarakteristikalar to'plami
     * @param string $id Product id raqami
     * @throws \Yii\web\NotFoundHttpException
     */
    public function actionCharacters($id = '')
    {
        $model = $this->findModel($id);
        $query = $model->getCharacterAssigns();
        $searchModel = new ProductCharacterAssignSearch();
        $dataProvider = $searchModel->search($query);
        return $this->render('characters', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionEditCharacters($id = '')
    {
        $model = $this->findModel($id);
        $characterAssigns = $model->characterAssigns;
        $dform = new DynamicFormModel([
            'models' => $characterAssigns,
            'modelClass' => ProductCharacterAssign::class,
            'modelsAttributes' => ['product_id' => $id],
            'sortAttribute' => 'sort_order',
            'deleteOldModels' => true,
            'errorMessage' => "Xarakteristika ma'lumotlarini saqlashda xatolik yuz berdi",
        ]);


        if ($dform->loadSave()) {
            return $this->redirect(['characters', 'id' => $id]);
        }
        return $this->render('editCharacters', [
            'model' => $model,
            'dform' => $dform,
        ]);

    }

    //</editor-fold>
}
