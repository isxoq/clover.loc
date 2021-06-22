<?php



/* @var $this \yii\web\View */
/* @var $form \soft\widget\kartik\ActiveForm|\yii\base\Widget */
/* @var $model \backend\modules\productmanager\models\Product|\yii\db\ActiveRecord */

use soft\widget\kartik\Form;

?>
<br>
<?= Form::widget([
    'model' => $model,
    'form' => $form,
//    'colMd' => 6,
    'initCard' => false,
    'columns' => 2,
    'attributes' => [
        'meta_title',
        'meta_keyword',
        'meta_description:textarea',
    ]
]); ?>
