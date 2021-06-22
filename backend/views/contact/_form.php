<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\models\Contact */
/* @var $form ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>

    <?= Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'name'=>[
                'options' => [
                    'readonly'=>'readonly'
                ],
              ],
              'title'=>[
                  'options' => [
                      'readonly'=>'readonly'
                  ],
              ],
              'text:textarea'=>[
                  'options' => [
                      'readonly'=>'readonly'
                  ],
              ],
              'phone'=>[
                  'options' => [
                      'readonly'=>'readonly'
                  ],
              ],
              'email'=>[
                  'options' => [
                      'readonly'=>'readonly'
                  ],
              ],
              'status:status',
        ]
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

