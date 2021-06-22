<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Ro'yhatdan o'tish";
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
                            <a class="nav-link active border-no lh-1 ls-normal" href="#signin"><?= t('Register') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="signin">
                            <?php Pjax::begin([
                                // Опции Pjax
                            ]); ?>
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                            <div class="form-group">
                                <?= $form->field($model, 'phone')->widget(\soft\widget\input\PhoneMaskedInput::class)->label(t('Phone number')) ?>
                            </div>
                            <?= Html::submitButton(t('Register'), ['class' => 'btn btn-dark btn-block btn-rounded', 'name' => 'signup-button']) ?>
                            <?php ActiveForm::end(); ?>
                            <?php Pjax::end(); ?>
                            <div class="form-choice text-center">
                                <?= Html::a(t('Already have an acccount?').'  '.t('Log in to the site').'!', ['auth/login'], ['class' => 'lost-link', 'style' => 'margin-top:15px']) ?>
                                <label class="ls-m">or Register With</label>
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
