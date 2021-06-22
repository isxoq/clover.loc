<?php

namespace backend\modules\ordermanager\models;

use frontend\models\Product;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $card_number
 * @property string|null $card_expiry
 * @property string|null $card_phone
 * @property int|null $product_id
 * @property int|null $loan_price
 * @property int|null $first_payment
 * @property int|null $month
 * @property int|null $created_date
 * @property int|null $status
 */
class Loan extends ActiveRecord
{

    const STATUS_PENDING = 1;

    public static function tableName()
    {
        return 'loan';
    }

    public function rules()
    {
        return [
            [['user_id', 'product_id', 'loan_price', 'first_payment', 'month', 'created_date', 'status'], 'integer'],
            [['first_name', 'last_name', 'card_number', 'card_expiry', 'card_phone'], 'string', 'max' => 255],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'card_number' => Yii::t('app', 'Card Number'),
            'card_expiry' => Yii::t('app', 'Card Expiry'),
            'card_phone' => Yii::t('app', 'Card Phone'),
            'product_id' => Yii::t('app', 'Product ID'),
            'loan_price' => Yii::t('app', 'Loan Price'),
            'first_payment' => Yii::t('app', 'First Payment'),
            'month' => Yii::t('app', 'Month'),
            'created_date' => Yii::t('app', 'Created Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function statuses()
    {
        return [
            self::STATUS_PENDING => Yii::t('app', 'Status Pending')
        ];
    }

}
