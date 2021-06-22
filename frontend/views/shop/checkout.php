<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/15/2021
 * Time: 9:56 AM
 * Project name: shop
 */

use frontend\components\Cart;
use \yii\widgets\ActiveForm;

$cartProducts = Cart::products();
$count = Cart::totalCount();
$cart = Cart::cart();
$sum = Cart::formattedTotalSum();


$this->registerJsFile('/js/order.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>


<main class="main checkout">
    <div class="page-content pt-7 pb-10 mb-10">
        <?= $this->render('partials/_checkout_menu', [
            'completed' => $completed
        ]) ?>

        <div class="container mt-7">

            <div class="card accordion">
                <div class="alert alert-light alert-primary alert-icon mb-4 card-header">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="text-body"><?= t('Have a coupon?') ?></span>
                    <a href="#alert-body2" class="text-primary"><?= t('Click here to enter your code') ?></a>
                </div>
                <div class="alert-body mb-4 collapsed" id="alert-body2">
                    <p><?= t('If you have a coupon code, please apply it below.') ?></p>
                    <div class="check-coupon-box d-flex">
                        <input type="text" name="coupon_code" class="input-text form-control text-grey ls-m mr-4"
                               id="coupon_code" value="" placeholder="Coupon code">
                        <button type="submit"
                                class="btn btn-dark btn-rounded btn-outline"><?= t('Apply Coupon') ?></button>
                    </div>
                </div>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'orderForm',
                'options' => [
                    'summaryUrl' => \yii\helpers\Url::to(['shop/summary'], true)
                ]
            ]) ?>
            <?= $form->errorSummary($model) ?>
            <div class="row">
                <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
                    <h3 class="title title-simple text-left text-uppercase"><?= t('Billing Details') ?></h3>
                    <div class="row">
                        <div class="col-xs-6">
                            <?= $form->field($model, 'firstname')->textInput([
                                'readOnly' => true,
                                'value' => user('first_name')
                            ]) ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $form->field($model, 'lastname')->textInput([
                                'readOnly' => true,
                                'value' => user('last_name')
                            ]) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'town_id')->dropDownList(map(\backend\modules\ordermanager\models\Town::findAll(['status' => \backend\modules\ordermanager\models\Town::STATUS_ACTIVE]), 'id', 'title'), [
                        'prompt' => Yii::t('app', 'Tanlang...')
                    ]) ?>
                    <?= $form->field($model, 'address')->textarea(['rows' => 5, 'value' => user('address')]) ?>



                    <?php if (user('phone')): ?>
                        <div class="row">
                            <div class="col-xs-6">
                                <?= $form->field($model, 'zip')->textInput() ?>
                            </div>
                            <div class="col-xs-6">
                                <?= $form->field($model, 'phone')->textInput([
                                    'readOnly' => true
                                ]) ?>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="row">
                            <div class="col-xs-6">
                                <?= $form->field($model, 'zip')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">
                                <?= $form->field($model, 'phone', ['options' => [
                                    'id' => "verify_phone"
                                ]])->widget(soft\widget\input\PhoneMaskedInput::class) ?>
                                <div class="form-group blok_verify">
                                    <a href="" id="get_verify_code"><?= t('Get Verfy Code') ?></a>
                                    <a href=""
                                       data-href="<?= \soft\helpers\Url::to(['auth/ajax-resend-phone-verify-code']) ?>"
                                       id="resend_verify_code" class="d-none"><?= t('Resend Verfy Code') ?></a>
                                </div>
                            </div>

                            <div class="col-xs-3 blok_verify">
                                <div class="form-group field-checkoutform-phone required has-error">
                                    <label class="control-label"
                                           for="verify-code"><?= t('Tasdiq kodi') ?></label>
                                    <input required type="text" id="verify_code" class="form-control"
                                           name="phone_code" aria-required="true">
                                </div>
                            </div>
                            <div class="col-xs-2 blok_verify">
                                <div class="form-group">
                                    <label for=""></label>
                                    <a data-href="<?= \soft\helpers\Url::to(['auth/ajax-send-phone-verify-code']) ?>"
                                       data-verify="<?= \soft\helpers\Url::to(['auth/ajax-verify-phone-verify-code']) ?>"
                                       id="verify_button"
                                       class="mt-2 btn btn-sm btn-primary btn-disabled"><?= t('Verify code') ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <br>
                    <h2 class="title title-simple text-uppercase text-left"><?= t('Additional Information') ?></h2>
                    <?= $form->field($model, 'notes')->textarea(['rows' => 5]) ?>
                </div>
                <aside class="col-lg-5 sticky-sidebar-wrapper">
                    <div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
                        <div class="summary pt-5">
                            <h3 class="title title-simple text-left text-uppercase"><?= t('Your Order') ?></h3>
                            <table class="order-table">
                                <thead>
                                <tr>
                                    <th><?= t('Products') ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($cartProducts as $product): ?>
                                    <tr>
                                        <td class="product-name"><?= $product->name ?><span
                                                    class="product-quantity">×&nbsp;<?= $cart[$product->id] ?></span>
                                        </td>
                                        <td class="product-total text-body"><?= Yii::$app->formatter->asSum($product->price) ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="sumnary-shipping shipping-row-last">
                                    <td colspan="2">
                                        <h4 class="summary-subtitle"><?= t('Calculate Shipping') ?></h4>
                                        <ul>
                                            <?php foreach (\backend\modules\ordermanager\models\CheckoutForm::shippingMethods() as $key => $method): ?>

                                                <li>
                                                    <div class="custom-radio">
                                                        <input type="radio" value="<?= $key ?>" id="method<?= $key ?>"
                                                               name="CheckoutForm[shipping]"
                                                               class="custom-control-input" <?= $key == 1 ? "checked" : "" ?>>
                                                        <label class="custom-control-label"
                                                               for="method<?= $key ?>"><?= $method ?></label>
                                                    </div>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="summary-total">
                                    <td class="pb-0">
                                        <h4 class="summary-subtitle"><?= t('Total') ?></h4>
                                    </td>
                                    <td class=" pt-0 pb-0">
                                        <p id="totalSummary"
                                           class="summary-total-price ls-s text-primary"><?= Cart::totalSum() ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="order-table">
                                <tbody>
                                <tr class="sumnary-shipping shipping-row-last">
                                    <td colspan="2">
                                        <h4 class="summary-subtitle"><?= t('Payment Method') ?></h4>
                                        <ul>
                                            <li>
                                                <div class="custom-radio">
                                                    <input type="radio"
                                                           value="<?= \backend\modules\ordermanager\models\CheckoutForm::CASH_ON_DELIVERY ?>"
                                                           id="paymentmethod<?= \backend\modules\ordermanager\models\CheckoutForm::CASH_ON_DELIVERY ?>"
                                                           name="CheckoutForm[payment_method]"
                                                           class="custom-control-input" checked>
                                                    <label class="custom-control-label"
                                                           for="paymentmethod<?= \backend\modules\ordermanager\models\CheckoutForm::CASH_ON_DELIVERY ?>"><?= t('Cash on delivery') ?></label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="custom-radio">
                                                    <input type="radio"
                                                           value="<?= \backend\modules\ordermanager\models\CheckoutForm::ONLINE_PAYMENT ?>"
                                                           id="paymentmethod<?= \backend\modules\ordermanager\models\CheckoutForm::ONLINE_PAYMENT ?>"
                                                           name="CheckoutForm[payment_method]"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label"
                                                           for="paymentmethod<?= \backend\modules\ordermanager\models\CheckoutForm::ONLINE_PAYMENT ?>"><?= t('Online payment') ?></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-checkbox mt-4 mb-5">
                                <input type="checkbox" checked class="custom-checkbox" id="terms-condition"
                                       name="terms-condition"/>
                                <label class="form-control-label" for="terms-condition">
                                    <?= Yii::$app->acf->getValue('terms_conditions') ?>
                                </label>
                            </div>
                            <button type="submit"
                                    class="btn btn-dark btn-rounded btn-order"><?= t('Place Order') ?></button>
                        </div>
                    </div>
                </aside>
            </div>
            <?php $form = ActiveForm::end() ?>

        </div>
    </div>
</main>
<!-- End Main -->