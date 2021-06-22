<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/17/2021
 * Time: 2:17 PM
 * Project name: shop
 */


use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = t('Set new password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-content mt-6 pb-2 mb-10">
    <div class="container">
        <div class="login-popup">
            <div class="form-box">
                <div class="tab tab-nav-simple tab-nav-boxed form-tab">
                    <ul class="nav nav-tabs nav-fill align-items-center border-no justify-content-center mb-5"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border-no lh-1 ls-normal"
                               href="#signin"><?= t('Set new password') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="signin">
                            <?php Pjax::begin([
                                // Опции Pjax
                            ]); ?>
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                            <div class="form-group mb-3">
                                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => t('Password') . ' *'])->label(t('Password') . ' *') ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control', 'placeholder' => t('Repeat new password') . ' *'])->label(t('Repeat new password') . ' *') ?>
                            </div>
                            <?= Html::submitButton(t('Data validation'), ['class' => 'btn btn-dark btn-block btn-rounded', 'name' => 'signup-button']) ?>
                            <?php ActiveForm::end(); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>