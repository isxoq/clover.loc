<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/11/2021
 * Time: 1:18 PM
 * Project name: shop
 */

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Profilni to'ldiring";
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
                <?= $form->errorSummary($model) ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->textInput() ?>
                <?= $form->field($model, 'password_repeat')->textInput() ?>

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

