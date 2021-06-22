<?php

namespace backend\modules\ordermanager\models;


use frontend\components\Cart;

/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/17/2021
 * Time: 2:50 PM
 * Project name: shop
 *
 * @property-read int $totalSummary
 */
class CheckoutForm extends \yii\base\Model
{
    public $firstname;
    public $lastname;
    public $phone;
    public $town_id;
    public $address;
    public $zip;
    public $notes;
    public $shipping;
    public $payment_method;

    const FLAT_RATE = 1;
    const FREE_SHIPPING = 2;
    const LOCAL_PICKUP = 3;
    const FAST_DELIVERY = 4;

    const CASH_ON_DELIVERY = 1;
    const ONLINE_PAYMENT = 2;

    public function rules()
    {
        return [

            [['firstname', 'phone', 'town_id', 'address', 'shipping', 'payment_method'], 'required'],
            [['firstname', 'lastname', 'phone', 'address', 'zip', 'notes'], 'string'],
            [['lastname', 'zip', 'notes'], 'safe'],
            [['town_id'], 'exist', 'skipOnError' => true, 'targetClass' => Town::class, 'targetAttribute' => ['town_id' => 'id']],

        ];
    }

    public static function shippingMethods()
    {
        return [
//            self::FLAT_RATE => \Yii::t('app', 'Flat Rate'),
            self::FAST_DELIVERY => \Yii::t('app', 'Fast delivery'),
            self::FREE_SHIPPING => \Yii::t('app', 'Free shipping'),
            self::LOCAL_PICKUP => \Yii::t('app', 'Local pickup'),
        ];
    }

    public static function paymentMethods()
    {
        return [
            self::CASH_ON_DELIVERY => \Yii::t('app', 'Cash on delivery'),
            self::ONLINE_PAYMENT => \Yii::t('app', 'Online payment'),
        ];
    }

    public function getTotalSummary()
    {
        $total = 0;
        $total += Cart::totalSum();
        if ($this->shipping == self::FAST_DELIVERY) {
            $total += Town::findOne(['id' => $this->town_id])->delivery_price;
        }
        return $total;

    }

    public function attributeLabels()
    {
        return [
            'firstname' => \Yii::t('app', 'Firstname'),
            'lastname' => \Yii::t('app', 'Lastname'),
            'town_id' => \Yii::t('app', 'Town ID'),
            'address' => \Yii::t('app', 'Address'),
            'zip' => \Yii::t('app', 'ZIP'),
            'phone' => \Yii::t('app', 'Phone'),
            'notes' => \Yii::t('app', 'Notes'),
        ];
    }

}

?>