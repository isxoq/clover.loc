<?php

/** @var \kartik\form\ActiveForm $form */

/** @var \backend\modules\productmanager\models\Category $node */

use kartik\widgets\SwitchInput;
use soft\helpers\Html;
use backend\modules\productmanager\models\Category;
use soft\widget\dosamigos\fileinput\FileInput;

$languages = Yii::$app->params['languages'];

if (!empty($languages)) {

    foreach ($languages as $key => $lang) {
        echo $form->field($node, 'title_' . $key);
    }
}
?>

<?php if ($node->lvl != 0) : ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($node, 'icon_type')->dropDownList(Category::iconTypes()); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($node, 'icon') ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($node, 'status')->widget(SwitchInput::class, [
                'pluginOptions' => [
                    'onText' => Yii::t('site', 'Active'),
                    'offText' => Yii::t('site', 'Inactive'),
                ],
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($node, 'image')->widget(FileInput::class, [

                'onlyImage' => true,
                'imgUrl' => $node->imageUrl,

            ]); ?>
        </div>
    </div>


<?php endif; ?>

<?= Html::submitButton() ?>
