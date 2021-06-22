<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/27/2021
 * Time: 11:10 AM
 * Project name: shop
 */

$this->title = t('Personal Informaton');
$this->params['bodyClass'] = '';
$this->params['mainClass'] = 'account';
$this->addBreadCrumb($this->title);
?>


<div class="page-content mt-4 mb-10 pb-6">
    <div class="container">
        <h2 class="title title-center mb-10"><?= $this->title ?></h2>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['options' => [
            'enctype' => "multipart/form-data"
        ]]) ?>
        <div class="row">
            <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
                <h3 class="title title-simple text-left text-uppercase"><?= t('Billing Details') ?></h3>

                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($user, 'first_name')->textInput([
                            'readOnly' => true,
                            'value' => user('first_name')
                        ]) ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($user, 'last_name')->textInput([
                            'readOnly' => true,
                            'value' => user('last_name')
                        ]) ?>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-xs-6">
                        <?= $form->field($user, 'work')->textInput([
                            'value' => user('work')
                        ]) ?>
                    </div>

                    <div class="col-xs-6">
                        <?= $form->field($user, 'profession')->textInput([
                            'value' => user('profession')
                        ]) ?>
                    </div>

                </div>

                <div class="row mt-5">
                    <div class="col-xs-6">
                        <?= $form->field($user, 'salary')->textInput([
                            'value' => user('salary')
                        ]) ?>
                    </div>
                </div>

                <h2 class="title title-simple text-uppercase text-left mt-7"><?= t('Passport Information') ?></h2>

                <div class="row mt-5">
                    <div class="col-xs-2">
                        <img class="img img-thumbnail"
                             src="<?= $user->passport_front ? $user->passport_front : "/images/passport1.png" ?>"
                             alt="">
                    </div>
                    <div class="col-xs-10">
                        <?= $form->field($user, 'passport_front')->fileInput() ?>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-xs-2">
                        <img class="img img-thumbnail"
                             src="<?= $user->passport_back ? $user->passport_back : "/images/passport2.png" ?>"
                             alt="">
                    </div>
                    <div class="col-xs-10">
                        <?= $form->field($user, 'passport_back')->fileInput() ?>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-xs-2">
                        <img class="img img-thumbnail"
                             src="<?= $user->passport_with_person ? $user->passport_with_person : "/images/passport3.png" ?>"
                             alt="">
                    </div>
                    <div class="col-xs-10">
                        <?= $form->field($user, 'passport_with_person')->fileInput() ?>
                    </div>
                </div>

                <button type="submit" class="mt-7 btn btn-success"><?= t('Save') ?></button>

            </div>
            <aside class="col-lg-5 mb-6 mb-lg-0 pr-lg-4">
                <h2 class="title title-simple text-uppercase text-left"><?= t('CARD Information') ?></h2>

                <div class="row mt-5">
                    <div class="col-xs-8">
                        <?= $form->field($user, 'card_number')->widget(yii\widgets\MaskedInput::class, [
                            'mask' => '9999 9999 9999 9999',
                        ]) ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($user, 'card_expiry')->widget(yii\widgets\MaskedInput::class, [
                            'mask' => '99/99',
                        ]) ?>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-xs-12">
                        <?= $form->field($user, 'card_phone')->widget(yii\widgets\MaskedInput::class, [
                            'mask' => '+\9\9\8(99) 999 99 99',
                        ]) ?>
                    </div>
                </div>
            </aside>
        </div>
        <?php \yii\bootstrap4\ActiveForm::end() ?>

    </div>
</div>
<!-- End Main -->
