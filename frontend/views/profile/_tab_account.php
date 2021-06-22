<?php

/*
 * @author Shukurullo Odilov
 * @date 17.05.2021, 10:44
 */

use kartik\form\ActiveForm;
use soft\helpers\Html;

/* @var $this \yii\web\View */
/** @var \frontend\models\PersonalDataForm $personalDataModel */

?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'form'
    ]
]) ?>

<form action="#" class="form">

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($personalDataModel, 'first_name') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($personalDataModel, 'last_name') ?>
        </div>
    </div>

    <?= $form->field($personalDataModel, 'address') ?>

    <fieldset>
        <legend><?= t('Change password') ?></legend>
        <p class="text-info"><?= t('Leave blank empty no to change password') ?></p>

        <?= $form->field($personalDataModel, 'current_password')->passwordInput() ?>
        <?= $form->field($personalDataModel, 'new_password')->passwordInput() ?>
        <?= $form->field($personalDataModel, 'repeat_new_password')->passwordInput() ?>

    </fieldset>

    <button type="submit" class="btn btn-primary"><?= t('Save changes') ?></button>
    <?php ActiveForm::end() ?>

