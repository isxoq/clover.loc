<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\models\BannerGroup */
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
        'content:textarea',
        'img:dosamigosFileImage' => [
            'options' => [
                'thumbnail' => Html::img($model->getImageUrl(), ['style' => ['max-width' => '200px', 'max-height' => '200px']]),
            ],
            'label' => false,
        ],
        'button_label1',
        'button_url1',
        'button_label2',
        'button_url2',
        'status:status',
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

