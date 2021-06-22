<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/19/2021
 * Time: 2:39 PM
 * Project name: shop
 */

?>

<main class="main order">
    <div class="page-content pt-7 pb-10 mb-10">
        <?= $this->render('partials/_checkout_menu', [
            'completed' => $completed
        ]) ?>
        <div class="container mt-8">
            <div class="order-message mr-auto ml-auto">
                <div class="icon-box d-inline-flex align-items-center">
                    <div class="icon-box-icon mb-0">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                             enable-background="new 0 0 50 50" xml:space="preserve">
									<g>
                                        <path fill="none" stroke-width="3" stroke-linecap="round"
                                              stroke-linejoin="bevel" stroke-miterlimit="10" d="
											M33.3,3.9c-2.7-1.1-5.6-1.8-8.7-1.8c-12.3,0-22.4,10-22.4,22.4c0,12.3,10,22.4,22.4,22.4c12.3,0,22.4-10,22.4-22.4
											c0-0.7,0-1.4-0.1-2.1"></path>
                                        <polyline fill="none" stroke-width="4" stroke-linecap="round"
                                                  stroke-linejoin="bevel" stroke-miterlimit="10" points="
											48,6.9 24.4,29.8 17.2,22.3 	"></polyline>
                                    </g>
								</svg>
                    </div>
                    <div class="icon-box-content text-left">
                        <h5 class="icon-box-title font-weight-bold lh-1 mb-1"><?= t('Thank You!') ?></h5>
                        <p class="lh-1 ls-m"><?= t('Your order has been received') ?></p>
                    </div>
                </div>
            </div>


            <div class="order-results">
                <div class="overview-item">
                    <span><?= t('Order Number') ?></span>
                    <strong><?= $loan->id ?></strong>
                </div>
                <div class="overview-item">
                    <span><?= t('Status') ?></span>
                    <strong><?= \backend\modules\ordermanager\models\Loan::statuses()[$loan->status] ?></strong>
                </div>
                <div class="overview-item">
                    <span><?= t('Date') ?></span>
                    <strong><?= Yii::$app->formatter->asDatetime($loan->created_date) ?></strong>
                </div>
                <div class="overview-item">
                    <span><?= t('Total') ?></span>
                    <strong><?= Yii::$app->formatter->asSum($loan->loan_price) ?></strong>
                </div>
            </div>

            <h2 class="title title-simple text-left pt-4 font-weight-bold text-uppercase"><?= t('Order Details') ?></h2>
            <div class="order-details">
                <table class="order-details-table">
                    <thead>
                    <tr class="summary-subtotal">
                        <td>
                            <h3 class="summary-subtitle"><?= t('Product') ?></h3>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="product-name"><?= $loan->product->name ?><span> <i class="fas fa-times"></i>
											1</span></td>
                        <td class="product-price"><?= Yii::$app->formatter->asSum($loan->product->loan_price) ?></td>
                    </tr>


                    <tr class="summary-subtotal">
                        <td>
                            <h4 class="summary-subtitle"><?= t('Total') ?></h4>
                        </td>
                        <td>
                            <p class="summary-total-price"><?= Yii::$app->formatter->asSum($loan->loan_price) ?></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <a href="<?= \yii\helpers\Url::home() ?>"
               class="mt-7 btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"><i
                        class="d-icon-arrow-left"></i><?= t('Back to Home') ?></a>
        </div>
    </div>
</main>
<!-- End Main -->
