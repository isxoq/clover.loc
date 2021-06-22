<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\modules\usermanager\models\User */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'username',
        'email',
        'first_name',
        'last_name',
        'phone',
        'address',
        'status:select2' => [
            'options' => [
                'data' => \common\models\User::getStatuses(),
            ],
            'pluginOptions' => [
                'allowClear' => false
            ]
        ],
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

