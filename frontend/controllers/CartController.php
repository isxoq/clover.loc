<?php


namespace frontend\controllers;

use soft\helpers\SiteHelper;
use Yii;
use frontend\models\Product;
use soft\web\SoftController;
use frontend\components\Cart;

class CartController extends SoftController
{
    public function init()
    {
        SiteHelper::setLanguage();
        parent::init();
    }

    /**
     * Product card dagi tugma orqali savatchaga qo'shish
     **/
    public function actionAdd()
    {
        $product_id = Yii::$app->request->get('product_id');
        $product = Product::find()->id($product_id)->active()->one();
        if ($product == null) {
            return $this->error();
        }
        $quantity = Yii::$app->request->get('qty', 1);
        Cart::add($product_id, $quantity);
        $data = [
            'header_cart_content' => $this->renderAjax('@frontend/views/layouts/header/_header_cart_content'),

//            Options for Riode.Minipopup.open()

            'message' => t('Added to cart'),
            'product_name' => $product->name,
            'product_url' => $product->detailUrl,
            'image_src' => $product->getImage(),
            'product_price' => $product->name,
            'price' => $product->formattedPrice,
            'count' => Cart::productCount($product_id),
            'template' => '<div class="action-group d-flex">
                                <a href="' . to(['shop/view-cart']) . '" class="btn btn-sm btn-outline btn-primary btn-rounded">
                                    ' . t('View cart') . '
                                </a>
                            </div>',
        ];

        return $this->success($data);

    }


    /**
     * Remove product from shopping cart
     * @return \yii\web\Response
     */
    public function actionRemove()
    {
        $product_id = Yii::$app->request->get('product_id');
        $is_view_cart_page = Yii::$app->request->get('is_view_cart_page', false);
        Cart::remove($product_id);
        if (Yii::$app->request->isAjax) {
            $result['success'] = true;
            $result['data'] = [
                'header_cart_content' => $this->renderAjax('@frontend/views/layouts/header/_header_cart_content'),
                'view_cart_content' => $is_view_cart_page ? $this->renderAjax('@frontend/views/shop/_cart_content') : '',
            ];
            return $this->asJson($result);
        }
        return $this->back();
    }

    /**
     * Minus from cart
     * @return \yii\web\Response
     */
    public function actionMinus()
    {

        $product_id = Yii::$app->request->get('product_id');
        Cart::minus($product_id);
        if (Yii::$app->request->isAjax) {
            $result['success'] = true;
            $result['data'] = [
                'header_cart_content' => $this->renderAjax('@frontend/views/layouts/header/_header_cart_content'),
                'view_cart_content' => $this->renderAjax('@frontend/views/shop/_cart_content'),
            ];
            return $this->asJson($result);
        }
        return $this->back();
    }

    /**
     * Plus to cart
     * @return \yii\web\Response
     */
    public function actionPlus()
    {
        $product_id = Yii::$app->request->get('product_id');
        Cart::add($product_id);
        if (Yii::$app->request->isAjax) {
            $result['success'] = true;
            $result['data'] = [
                'header_cart_content' => $this->renderAjax('@frontend/views/layouts/header/_header_cart_content'),
                'view_cart_content' => $this->renderAjax('@frontend/views/shop/_cart_content'),
            ];
            return $this->asJson($result);
        }
        return $this->back();
    }


    public function actionCheckout()
    {

        $products = Cart::products();
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->isGuest) {
                $model->status = 0;

                if ($model->save()) {

                    $pts = Cart::products();

                    foreach ($pts as $product) {
                        $orderitem = new Orderitem();
                        $orderitem->order_id = $model->id;
                        $orderitem->product_id = $product->id;
                        $orderitem->quality = $_SESSION['cart'][$product->id];
                        $orderitem->save();
                        unset($_SESSION['cart'][$product->id]);
                    }

                }
                return $this->redirect(['site/index']);
            } else {
                Yii::$app->session->setFlash("error", "Iltimos, Login va Parolingizni kiriting!");
                return $this->redirect(['site/login']);
            }
        }
        return $this->render('checkout', compact('products', 'model'));

    }


    public function actionClose1()
    {

        $product_id = Yii::$app->request->get('product_id');

        $result = [];

        if (Yii::$app->request->isAjax) {

            unset($_SESSION['cart'][$product_id]);

            $result['cartContent'] = $this->renderAjax('@frontend/views/layouts/header/_header_cart_content');

            $result['cartContent1'] = $this->renderAjax('@frontend/views/shop/cart_content');

            return $this->asJson($result);


        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param null|string $message
     * @return \yii\web\Response
     */
    private function error($message = null)
    {
        if ($this->isAjax) {
            $result = [
                'success' => false,
                'message' => $message
            ];
            return $this->asJson($result);
        }
        return $this->back();
    }

    /**
     * @param mixed $data
     * @param null|string $message
     * @return \yii\web\Response
     */
    private function success($data = null, $message = null)
    {
        if ($this->isAjax) {
            $result = [
                'success' => true,
                'data' => $data,
                'message' => $message
            ];
            return $this->asJson($result);
        }
        return $this->back();
    }

}