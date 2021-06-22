<?php

use soft\widget\kartik\Form;
use \backend\modules\productmanager\models\Category;
use \soft\widget\kartik\InputType;
use \backend\models\Brand;
use soft\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $form \soft\widget\kartik\ActiveForm|\yii\base\Widget */
/* @var $model \backend\modules\productmanager\models\Product|\yii\db\ActiveRecord */

$brands = Brand::find()->active()->all();

$data = ArrayHelper::map($brands, 'id', 'name');
?>
<br>
<?= Form::widget([
    'model' => $model,
    'form' => $form,
    'initCard' => false,
    'attributes' => [
        'name',
        'loan_price:sum',
        'price:sum' => [
            'fieldConfig' => [
                'enableClientValidation' => false
            ]
        ],
        'old_price:sum',
        'brand_id:select2' => [
            'options' => [
                'data' => $data
            ]
        ],
        'status:status',
        'category_id' => [
            'label' => 'Kategoriyalar',
            'type' => InputType::WIDGET,
            'widgetClass' => '\kartik\tree\TreeViewInput',
            'options' => [
                'query' => Category::find()->addOrderBy('root, lft'),
                'headingOptions' => ['label' => 'Kategoriyalar'],
                'name' => 'category-tree', // input name
                'asDropdown' => true,   // will render the tree input widget as a dropdown.
                'multiple' => false,     // set to false if you do not need multiple selection
                'fontAwesome' => true,  // render font awesome icons
                'nodeLabel' => function ($node) {
                    return $node->title;
                },
                'rootOptions' => [
                    'label' => '<i class="fa fa-tree"></i>',  // custom root label
                    'class' => 'text-success'
                ],
            ]
        ],
    ]
]); ?>

