<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = t('Login to the site');
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
                               href="#signin"><?= t('Login to the site') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="signin">
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <div class="form-group mb-3">
                                <?= $form->field($model, 'username')->widget(\soft\widget\input\PhoneMaskedInput::class) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => t('Password') . ' *'])->label(false) ?>
                            </div>
                            <div class="form-footer">
                                <div class="form-checkbox">
                                    <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'custom-checkbox'])->label(false) ?>
                                    <label class="form-control-label"
                                           for="signin-remember"><?= t('Remember me') ?></label>
                                </div>
                                <?= Html::a(t('Forget Password?'), ['auth/request-password-reset'], ['class' => 'lost-link', 'style' => 'margin-top:15px']) ?>

                            </div>
                            <?= Html::submitButton(t('Login to the site'), ['class' => 'btn btn-dark btn-block btn-rounded', 'name' => 'login-button']) ?>
                            <?php ActiveForm::end() ?>
                            <div class="form-choice text-center">
                                <?= Html::a(t('Don’t have an Account?') . '  ' . t('Register now!'), ['auth/signup'], ['class' => 'lost-link', 'style' => 'margin-top:15px']) ?>
                                <label class="ls-m">or Login With</label>
                                <div class="social-links">
                                    <?= yii\authclient\widgets\AuthChoice::widget([
                                        'baseAuthUrl' => ['auth/auth'],
                                        'popupMode' => false,

                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

