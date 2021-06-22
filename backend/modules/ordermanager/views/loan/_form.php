<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\modules\ordermanager\models\Loan */
/* @var $form ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>

    <?= Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
                  'user_id',
              'first_name',
              'last_name',
              'card_number',
              'card_expiry',
              'card_phone',
              'product_id',
              'loan_price',
              'first_payment',
              'month',
              'created_date',
              'status',
        ]
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

