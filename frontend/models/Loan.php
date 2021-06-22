<?php

namespace frontend\models;
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/26/2021
 * Time: 4:50 PM
 * Project name: shop
 */

use yii;

class Loan extends \yii\base\Model
{
    public $month;
    public $product_id;
    public $first_payment;

    public function rules(): array
    {
        return [
            [['month', 'product_id'], 'required']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'month' => Yii::t('app', 'Month'),
            'product_id' => Yii::t('app', 'Product ID'),
            'first_payment' => Yii::t('app', 'First Payment'),
        ];
    }

    public function getProduct()
    {
        $product = Product::findOne($this->product_id);
        return $product;
    }

}


?>