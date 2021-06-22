<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;

$typs = \soft\helpers\ArrayHelper::map(\backend\models\FaqType::find()->active()->all(), 'id', 'name');
/* @var $this soft\web\View */
/* @var $model backend\models\Faq */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'question',
        'asked:ckeditor',
        'status:status',
        'faq_type_id:select2' => [
            'options' => [
                'data' => $typs

            ]
        ],
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

