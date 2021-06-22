<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\modules\usermanager\models\Customer */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
//        'username',
//        'auth_key',
//        'password_hash',
//        'password_reset_token',
//        'email',
//        'status',
        'first_name',
        'last_name',
        'phone',
        'address',
        'password',
        'status:select2' => [
            'options' => [
                'data' => \common\models\User::getStatuses(),
            ],
            'pluginOptions' => [
                'allowClear' => false
            ]
        ],

//        'code',
//        'verify_time',
//        'wish_list',
//        'family',
//        'work',
//        'profession',
//        'experience',
//        'salary',
//        'passport_front',
//        'passport_back',
//        'passport_with_person',
//        'card_number',
//        'card_expiry',
//        'card_phone',
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

