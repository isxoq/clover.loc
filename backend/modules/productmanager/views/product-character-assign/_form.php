<?php

use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;


/* @var $this soft\web\View */
/* @var $model backend\modules\productmanager\models\ProductCharacterAssign */
/* @var $form ActiveForm */

$charactersMap = map(\backend\modules\charactermanager\models\Character::getAll(), 'id', 'name');


?>


<?php $form = ActiveForm::begin(); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'character_id:dropdownList' => [
            'items' => $charactersMap,
        ],
        'value',
        'status:checkbox:Aktiv',
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

