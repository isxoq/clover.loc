<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/26/2021
 * Time: 9:27 AM
 * Project name: shop
 */


?>


<main class="main checkout">
    <div class="page-content pt-7 pb-10 mb-10">
        <div class="container mt-7">

            <?php $form = \yii\bootstrap\ActiveForm::begin() ?>
<<<<<<< HEAD
=======
            <?= $form->errorSummary($model) ?>
>>>>>>> 34e8afb9d17c0c5d2da55426c6267853bc9c27af
            <div class="row">
                <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
                    <h3 class="title title-simple text-left text-uppercase"><?= t('kupit v Rassrochku') ?></h3>
                    <div class="row">
                        <div class="col-xs-6">
                            <?= $form->field($model, 'first_payment')->textInput(
                                [
                                    'readOnly' => true,
<<<<<<< HEAD
<<<<<<< HEAD
                                    'value' => Yii::$app->formatter->asSum($product->loan_price * 0.15)
=======
                                    'value' => $product->loan_price * 0.15
>>>>>>> 34e8afb9d17c0c5d2da55426c6267853bc9c27af
=======
>>>>>>> ba3f8b672688137ce03a04d8f05346bcba788119
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="row">
                        <h5><?= t('Taqsimlanish') ?></h5>
                        <div class="col-xs-6">
                            <ul style="list-style-type: none">
                                <?php for ($i = 3; $i <= 12; $i += 3): ?>
                                    <li>
                                        <div class="custom-radio">
                                            <input type="radio"
                                                   value="<?= $i ?>"
                                                   id="loan<?= $i ?>"
<<<<<<< HEAD
                                                   name="LoanForm[month]"
=======
                                                   name="Loan[month]"
>>>>>>> 34e8afb9d17c0c5d2da55426c6267853bc9c27af
                                                   class="custom-control-input" <?= $i == 3 ? "checked" : "" ?>>
                                            <label class="custom-control-label"
                                                   for="loan<?= $i ?>"><?= Yii::t('app', 'oyiga {month} {sum}', [
                                                    'month' => $i,
                                                    'sum' => Yii::$app->formatter->asSum(($product->loan_price - ($product->loan_price * 0.15)) / $i)
                                                ]) ?></label>
                                        </div>
                                    </li>
                                <?php endfor ?>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <h5><?= t('Your Billing Details') ?></h5>
                        <p class="address-detail pb-2">
                            <?= user('first_name') . " " . user('last_name') ?><br>
                            <?= user('address') ?><br>
                            <?= user('phone') ?>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-dark btn-rounded btn-order"><?= t('Order') ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
</main>
