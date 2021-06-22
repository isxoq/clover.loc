<?php

use soft\widget\dynamicform\DynamicFormWidget;
use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;
use soft\widget\adminlte3\Card;


/* @var $this \yii\web\View */
/* @var $models \backend\modules\charactermanager\models\Character[] */
/* @var $dform \soft\widget\dynamicform\DynamicFormModel */

$this->title = "Yangi qo'shish";

$groupsMap = map(\backend\modules\charactermanager\models\CharacterGroup::getAll(), 'id', 'name');

?>

<?php Card::begin() ?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<?php DynamicFormWidget::begin([

    'form' => $form,
    'formId' => 'dynamic-form',
    'data' => $dform,
    'formFields' => [
        'name', 'status', 'group_id'
    ],
    'columns' => [
        'name_uz',
        'name_ru',
        'group_id' => [

            'field' => function ($form, $model, $attribute) use ($groupsMap) {
                return $form->field($model, $attribute)->dropdownList($groupsMap)->label(false);
            },
            'label' => "Guruh",

        ],
        'status' => [
            'field' => function ($form, $model, $attribute)  {
                return $form->field($model, $attribute)->checkbox()->label("Aktiv");

            },
            'label' => "Status",
        ]
    ]


]) ?>

<?php DynamicFormWidget::end() ?>
<?php ActiveForm::end(); ?>

<?php Card::end() ?>
