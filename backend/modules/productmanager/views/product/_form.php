<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\adminlte3\Card;


/* @var $this soft\web\View */
/* @var $model backend\modules\productmanager\models\Product */
/* @var $form ActiveForm */


?>

<?php Card::begin() ?>

<?php $form = ActiveForm::begin([
    'id' => 'product-form'
]); ?>


<?= \yii\bootstrap4\Tabs::widget([
    'headerOptions' => ['class' => "m-1"],
    'items' => [
        [
            'label' => "Asosiy ma'lumotlar",
            'content' => $this->render('__formMain', [
                'form' => $form,
                'model' => $model
            ])
        ],

        [
            'label' => "Tavsif",
            'content' => $this->render('__formDescription', [
                'form' => $form,
                'model' => $model
            ])
        ],

        [
            'label' => "Meta ma'lumotlar",
            'content' => $this->render('__formMeta', [
                'form' => $form,
                'model' => $model
            ])
        ],

        [
            'label' => "Rasmlar",
            'content' => $this->render('__gallery', [
                'model' => $model
            ])
        ],
    ]
]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php Card::end() ?>