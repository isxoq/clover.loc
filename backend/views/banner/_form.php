<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\models\Banner */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'title',
        'description',
        'text1',
        'text2',
        'urlName',
        'url',

        'img:dosamigosFileImage' => [
            'options' => [
                'imgUrl' => $model->getImageUrl()
            ]
        ],
        'is_right:checkbox',
        'status:status',
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

