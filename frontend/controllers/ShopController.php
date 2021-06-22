<?php


namespace frontend\controllers;

use backend\models\Contact;
use backend\modules\ordermanager\models\CheckoutForm;
use backend\modules\ordermanager\models\Order;
use backend\modules\ordermanager\models\OrderItem;
use backend\modules\ordermanager\models\Town;
use common\models\User;
use frontend\components\Cart;
use backend\modules\ordermanager\models\Loan;
use frontend\models\Product;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use soft\helpers\SiteHelper;
use yii\web\Response;
use frontend\models\Loan as LoanForm;

class ShopController extends Controller
{

    public function init()
    {
        parent::init();
        SiteHelper::setLanguage();
    }

    public function actionViewCart()
    {

        return $this->render('view-cart', [
            'completed' => false
        ]);
    }

    public function actionContact()
    {

        $m = 0;

        $model = new Contact();

        if ($model->load(Yii::$app->request->post())) {

            $model->status = 0;

            $model->created_at = strtotime(date('d-m-Y H:i:s'));

            $model->save();

            $m = 1;

            $model = new Contact();

            return $this->render('contact', ['model' => $model, 'm' => $m]);

        }
        return $this->render('contact', compact('model', 'm'));
    }

    public function actionCheckout()
    {
        $model = new CheckoutForm();
        $model->phone = user('phone');

        if (is_guest()) {
            return $this->redirect(['auth/login']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $order = new Order();
                $order->user_id = user('id');
                $order->payment_type = $model->payment_method;
                $order->address = $model->address;
                $order->shipping_method = $model->shipping;
                $order->phone = $model->phone;
                $order->full_name = user('first_name') . " " . user('last_name');
                $order->total_amount = $model->getTotalSummary();
                $order->notes = $model->notes;
                $order->zip = $model->zip;
                $order->status = $order->setStatusLabel();
                $order->save();

                foreach (Cart::products() as $product) {

                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $product->id;
                    $orderItem->amount = Cart::productCount($product->id);
                    $orderItem->price = $product->price;
                    $orderItem->save();

                }


                Cart::clear();

                $transaction->commit();
                return $this->render('thanks', [
                    'order' => $order,
                    'completed' => true
                ]);


            } catch (\Exception $e) {
                $transaction->rollBack();
                dd($e->getMessage());
            }

        }
        return $this->render('checkout', [
            'model' => $model,
            'completed' => false
        ]);

    }


    public function actionThanks()
    {
        return $this->render('thanks');
    }

    public function actionSummary()
    {
        $totalSum = 0;
        $data = Yii::$app->request->post();
        $cartProducts = Cart::products();
        $count = Cart::totalCount();
        $cart = Cart::cart();
        $sum = Cart::totalSum();
        $totalSum += $sum;
        $city = Town::findOne($data['CheckoutForm']['town_id']);
        if ($city) {
            if ($data['CheckoutForm']['shipping'] == CheckoutForm::FAST_DELIVERY)
                $totalSum += $city->delivery_price;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'totalSum' => $totalSum
        ];

//        return $this->renderAjax('ajax/summary', compact('data'));
    }

    public function actionLoan($product_id)
    {

        $user = User::findOne(user('id'));

        if (!$user) {
            return $this->redirect(['auth/login']);
        }

        $product = Product::findActiveOne($product_id);
        if (!$product) {
            not_found();
        }

        if (!$user->canLoan()) {
            return $this->redirect(['profile/personal']);
        }


        $model = new LoanForm();
        $model->product_id = $product_id;
        $model->first_payment = $model->product->loan_price * 0.15;


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();


            try {
                $loan = new Loan();
                $loan->user_id = user('id');
                $loan->first_name = $user->first_name;
                $loan->last_name = $user->last_name;
                $loan->card_number = $user->card_number;
                $loan->card_expiry = $user->card_expiry;
                $loan->card_phone = $user->card_phone;
                $loan->product_id = $product->id;
                $loan->loan_price = $product->loan_price;
                $loan->first_payment = $model->first_payment;
                $loan->month = $model->month;
                $loan->created_date = date('U');
                $loan->status = Loan::STATUS_PENDING;
                $loan->save();

                $transaction->commit();
                return $this->render('thanks_loan', [
                    'loan' => $loan,
                    'completed' => true
                ]);


            } catch (\Exception $e) {
                $transaction->rollBack();
                dd($e->getMessage());
            }
        }

        return $this->render('loan', [
            'model' => $model,
            'product' => $product
        ]);
    }

}