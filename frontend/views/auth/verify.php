<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/11/2021
 * Time: 11:21 AM
 * Project name: shop
 */
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = t('Confirm the code');
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
                               href="#signin"><?= t('Confirm the code') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="signin">
                            <?php Pjax::begin([
                                // Опции Pjax
                            ]); ?>
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                            <div class="form-group">
                                <?= $form->field($model, 'code')->textInput(['autofocus' => true])->label(t('Enter the code')) ?>
<!--                                --><?php //if (!$model->isNotExpired()): ?>
<!--                                    <a href="--><?//= to(['site/resend-code']) ?><!--">Salom</a>-->
<!--                                --><?php //endif ?>
                            </div>
                            <?= Html::submitButton(t('Confirm the code'), ['class' => 'btn btn-dark btn-block btn-rounded', 'name' => 'signup-button']) ?>
                            <?php ActiveForm::end(); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
