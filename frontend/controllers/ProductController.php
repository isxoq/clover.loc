<?php

namespace frontend\controllers;

use backend\modules\productmanager\models\ProductCharacterAssign;
use soft\helpers\ArrayHelper;
use Yii;
use frontend\models\search\ProductSearch;
use soft\web\SoftController;
use frontend\models\Category;
use frontend\models\Product;
use soft\helpers\SiteHelper;

/**
 * Product controller
 */
class ProductController extends SoftController
{
    public function init()
    {
        parent::init();
        SiteHelper::setLanguage();
    }

    public function actionCategory($slug = "")
    {
        $category = Category::find()->active()->slug($slug)->one();

        if (!$category) {
            not_found();
        }

        $ids = array_column($category->getActiveProducts()->select('id')->asArray()->all(), 'id');

        $attributes = ProductCharacterAssign::find()->where(['product_id' => $ids])->one();

        $attributeValues = Yii::$app->request->get('filter', []);


//        dd($attributeValues);

        $query = $category->getActiveProducts();


        if (!empty($attributeValues)) {
            $query->joinWith(['characterAssigns' => function ($query) use ($attributeValues) {

                return $query->joinWith('translation')->andWhere(['product_character_assign_lang.value' => $attributeValues]);

            }]);
        }


        $minPriceFromAll = intval($query->min('price'));
        $maxPriceFromAll = intval($query->max('price'));
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($query);
        return $this->render('category', [
            'attributeValues' => $attributeValues,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'minPriceFromAll' => $minPriceFromAll,
            'maxPriceFromAll' => $maxPriceFromAll,
        ]);

    }

    public function actionDetail($slug)
    {
        $product = Product::find()->active()->slug($slug)->one();
        if ($product == null) {
            not_found();
        }
        if ($this->isAjax) {
            return $this->renderAjax('quick_view', [
                'product' => $product,
            ]);
        }
        return $this->render('detail', compact('product'));
    }

    public function actionSearch()
    {

        $search = Yii::$app->request->get('key');

        $query = Product::find()
            ->active()
            ->joinWith('translation')
            ->andFilterWhere(['like', 'product_lang.name', $search]);

        $minPriceFromAll = intval($query->min('price'));
        $maxPriceFromAll = intval($query->max('price'));
        $searchModel = new ProductSearch();

        $dataProvider = $searchModel->search($query);
        return $this->render('searchResults', [
            'dataProvider' => $dataProvider,
            'minPriceFromAll' => $minPriceFromAll,
            'maxPriceFromAll' => $maxPriceFromAll,
        ]);


    }

//    public function actionWishlist()
//    {
//
//        return $this->render('wishlist');
//    }

}
