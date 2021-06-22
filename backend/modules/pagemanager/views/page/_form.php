<?php
/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 14:24
 */

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\modules\pagemanager\models\Page */
/* @var $form ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'title',
//        'short_description:textarea',
        'content:ckeditor',
//        'image:dosamigosFileImage' => [
//            'imgUrl' => $model->getImage(),
//        ],
        'status:status',
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

