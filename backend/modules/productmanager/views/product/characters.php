<?php

use soft\helpers\Html;
use soft\helpers\Url;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\ProductCharacterAssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \backend\modules\productmanager\models\Product */

$this->title = 'Xarakteristikalar';
$this->registerAjaxCrudAssets();

$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_productMenu', ['model' => $model]) ?>


<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
//    'filterModel' => $searchModel,
    'toolbarTemplate' => '{edit-all}',
    'toolbarButtons' => [
        'edit-all' => [
            'pjax' => false,
            'modal' => false,
            'url' => Url::to(['edit-characters', 'id' => $model->id]),
            'cssClass' => 'btn btn-primary btn-flat',
            'icon' => 'edit',
            'title' => "Barchasini tahrirlash",
            'content' => "Yangi qo'shish va tahrirlash",

        ],
    ],
    'bulkButtonsTemplate' => "{delete}",
    'bulkButtons' => [
        'delete' => [
            'url' => to(['product-character-assign/bulkdelete']),
        ]
    ],
    'cols' => [
        'character.name',
        'value_uz',
        'value_ru',
        'status:status',
        'actionColumn' => [
            'controller' => 'product-character-assign',
//            'template' => "{update}{delete}",
            'dropdown' => false,
            'viewOptions' => [
                'role' => 'modal-remote',
            ],
            'updateOptions' => [
                'role' => 'modal-remote',
            ],
        ],
    ],
]); ?>
