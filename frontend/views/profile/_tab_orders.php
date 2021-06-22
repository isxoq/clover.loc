<?php
/*
 * @author Shukurullo Odilov
 * @date 17.05.2021, 10:44
 */


/* @var $this \yii\web\View */
?>

<table class="order-table">
    <thead>
    <tr>
        <th class="pl-2"><?= t('Order') ?></th>
        <th><?= t('Date') ?></th>
        <th><?= t('Status') ?></th>
        <th><?= t('Total') ?></th>
        <th class="pr-2"><?= t('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($models as $order): ?>
        <tr>
            <td class="order-number"><a href="#">#<?= $order->id ?></a></td>
            <td class="order-date">
                <time><?= Yii::$app->formatter->asDate($order->created_at) ?></time>
            </td>
            <td class="order-status"><span><?= $order->statusLabel ?></span></td>
            <td class="order-total"><span><?= Yii::$app->formatter->asSum($order->total_amount) ?></span></td>
            <td class="order-action">
                <?= $order->status == \backend\modules\ordermanager\models\Order::STATUS_PAYMENT_WAITING ? \backend\modules\click\widgets\ClickButtonWidget::widget([
                    'order_id' => $order->id,
                    'amount' => $order->total_amount,
                    'class' => 'btn btn-success',
                    'title' => Yii::t('app', 'Pay with CLICK')
                ]) : "" ?>
                <a href="#" class="btn btn-primary btn-link btn-underline"><?= t('View') ?></a>
            </td>
        </tr>
    <?php endforeach ?>
    <?= \yii\bootstrap4\LinkPager::widget([
        'pagination' => $pages
    ]) ?>
    </tbody>

</table>

