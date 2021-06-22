<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;
use backend\modules\postmanager\models\PostCategory;
use soft\helpers\ArrayHelper;

$catMap = ArrayHelper::map(PostCategory::find()->all(), 'id', 'name');


/* @var $this soft\web\View */
/* @var $model backend\modules\postmanager\models\Post */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<?= $form->errorSummary($model) ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'title',
        'short_description:textarea',
        'publishedAtField:datetime',
        'content:ckeditor',
        'status:status',
        'image:dosamigosFileImage' => [
            'options' => [
                'thumbnail' => Html::img($model->getLargeImage(), ['style' => ['max-width' => '200px', 'max-height' => '200px']]),
            ],
            'label' => false,
        ],
        'small_image:dosamigosFileImage' => [
            'options' => [
                'thumbnail' => Html::img($model->getSmallImage(), ['style' => ['max-width' => '200px', 'max-height' => '200px']]),
            ],
            'label' => false,
        ],
        'category_id:dropdownList' => [
            'items' => $catMap
        ]
    ]
]); ?>


<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

