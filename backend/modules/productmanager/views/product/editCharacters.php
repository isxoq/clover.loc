<?php

use soft\widget\dynamicform\DynamicFormWidget;
use soft\widget\adminlte3\Card;
use soft\widget\kartik\ActiveForm;


/* @var $this \yii\web\View */
/* @var $model \backend\modules\productmanager\models\Product */
/* @var $dform \soft\widget\dynamicform\DynamicFormModel */

$this->title = 'Qo\'shish';

$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => "Xarakteristikalar", 'url' => ['characters', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$charactersMap = map(\backend\modules\charactermanager\models\Character::getAll(), 'id', 'name');

?>


<?php Card::begin()  ?>

<?php $form = ActiveForm::begin([
    'id' => 'product-form'
]); ?>

<?php DynamicFormWidget::begin([

    'form' => $form,
    'formId' => 'product-form',
    'data' => $dform,
//    'min' => 0,
    'formFields' => [
        'value', 'status', 'character_id'
    ],
    'columns' => [

        'character_id' => [

            'field' => function ($form, $model, $attribute) use ($charactersMap) {
                return $form->field($model, $attribute)->dropdownList($charactersMap, [

                    'prompt' => '---'

                ])->label(false);
            },
            'label' => "Xarakteristika",

        ],

        'value_uz',
        'value_ru',

        'status' => [
            'field' => function ($form, $model, $attribute) {
                return $form->field($model, $attribute)->checkbox()->label("Aktiv");

            },
            'label' => "Status",
        ]
    ]


]) ?>

<?php DynamicFormWidget::end() ?>


<?php ActiveForm::end(); ?>

<?php Card::end()  ?>

