<?php

namespace backend\modules\ordermanager\models;

use common\models\User;
use soft\behaviors\CyrillicSlugBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $phone
 * @property string $zip
 * @property string $notes
 * @property string $address
 * @property string $full_name
 * @property int|null $payment_type
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $shipping_method
 * @property int|null $total_amount
 *
 * @property User $user
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{

    const STATUS_PENDING = 10;
    const STATUS_PAYMENT_WAITING = 20;

    const TYPE_RASSROCHKA = 36;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'total_amount', 'shipping_method', 'payment_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['phone'], 'required'],
            [['zip', 'notes', 'address'], 'string'],
            [['phone', 'full_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'phone' => Yii::t('app', 'Phone'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    public function getSubtotal()
    {
        $items = $this->orderItems;
        $sum = 0;
        foreach ($items as $item) {
            $sum += $item->price;
        }

        return $sum;

    }

    public function getShippingMethod()
    {
        return CheckoutForm::shippingMethods()[$this->shipping_method];
    }

    public function getStatusLabel()
    {
        return $this->statuses()[$this->status];
    }

    public function setStatusLabel()
    {
        if ($this->payment_type == CheckoutForm::CASH_ON_DELIVERY) {
            return self::STATUS_PENDING;
        } elseif ($this->payment_type == CheckoutForm::ONLINE_PAYMENT) {
            return self::STATUS_PAYMENT_WAITING;
        }
    }


    public function getPaymentMethod()
    {
        return \backend\modules\ordermanager\models\CheckoutForm::paymentMethods()[$this->payment_type];
    }

    public static function statuses()
    {
        return [
            self::STATUS_PENDING => Yii::t('app', 'Status Pending'),
            self::STATUS_PAYMENT_WAITING => Yii::t('app', 'Status Payment Waiting'),
        ];
    }

    public static function types()
    {
        return [
            self::TYPE_RASSROCHKA => Yii::t('app', 'Type Rassrochka'),
            self::TYPE_ROZNICA => Yii::t('app', 'Type Roznica'),
        ];
    }
}
