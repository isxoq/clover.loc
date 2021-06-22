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

$this->title = "Tasdiqlash";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Iltimos, quyidagilarni to'ldiring:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php Pjax::begin([
                    // Опции Pjax
                ]); ?>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'code')->textInput(['autofocus' => true]) ?>
                <?php if (!$model->isNotExpired()): ?>
                    <a href="<?= to(['site/resend-code']) ?>">Salom</a>
                <?php endif ?>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <?= Html::submitButton("Ro'yhatdan o'tish", ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
