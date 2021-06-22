<?php


namespace frontend\controllers;


use backend\models\Wishlist;
use frontend\models\Product;
use soft\helpers\SiteHelper;
use soft\web\SoftController;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class WishController extends SoftController
{
    public function init()
    {
        SiteHelper::setLanguage();
        parent::init();
    }

    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]

        ];
    }

    public function actionAddToWishlist()
    {
        if ($this->isAjax) {
            $this->formatJson();
        }

        $product_id = Yii::$app->request->get('product_id');
        $user = Yii::$app->user->identity;
        $product = Product::find()->active()->id($product_id)->one();
        if ($product == null) {
            not_found();
        }

        if ($product->isWished) {
            $user->removeFromWishList($product_id);
            $addClass = 'd-icon-heart';
        } else {
            $user->addToWishList($product_id);
            $addClass = 'd-icon-heart-full';
        }
        $result['class'] = $addClass;
        if ($this->isAjax) {
            return $this->asJson($result);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemoveFromWishlist()
    {
        $product_id = Yii::$app->request->get('product_id');
        $user = Yii::$app->user->identity;
        $user->removeFromWishList($product_id);

        if (Yii::$app->request->isAjax) {
            $result['wishlist'] = $this->renderAjax('@frontend/views/profile/wishlist', [
                'wishedProducts' => $user->wishedProducts,
            ]);
            return $this->asJson($result);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}