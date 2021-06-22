<?php

use soft\widget\kartik\Form;

/* @var $this \yii\web\View */
/* @var $form \soft\widget\kartik\ActiveForm|\yii\base\Widget */
/* @var $model \backend\modules\productmanager\models\Product */


?>
<br>
<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'initCard' => false,
    'attributes' => [
        'short_description:textarea',
        'description:ckeditor',
    ]
]); ?>
