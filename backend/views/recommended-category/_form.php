<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */

use soft\helpers\ArrayHelper;
use soft\helpers\Html;
use soft\widget\kartik\ActiveForm;
use soft\widget\kartik\Form;
use \soft\widget\kartik\InputType;
use \backend\modules\productmanager\models\Category;

/* @var $this soft\web\View */
/* @var $model backend\models\RecommendedCategory */
/* @var $form ActiveForm */
$category = Category::activeMainCategories();
$data = ArrayHelper::map($category, 'id', 'title');
?>


<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'attributes' => [
        'text1',
        'text2',
        'text3',
        'category_id:select2' => [
            'options' => [
                'data' => $data
            ]
        ],
        'image:dosamigosFileImage' => [
            'options' => [
                'thumbnail' => Html::img($model->getImageUrl(), ['style' => ['max-width' => '200px', 'max-height' => '200px']]),
            ],
            'label' => false,
        ],
        'button_label',
        'url',
        'status:status',
    ]
]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('site', 'Save'), ['visible' => !$this->isAjax]) ?>
</div>

<?php ActiveForm::end(); ?>

