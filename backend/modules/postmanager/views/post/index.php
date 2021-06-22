<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\postmanager\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'toolbarButtons' => [
        'create' => [
            'modal' => false
        ],
    ],
    'cols' => [
//        'id',
        'title',
        [
            'attribute' => 'category_id',
            'value' => 'category.name',
            'label' => 'Categoriya',
            'filter' => \soft\helpers\ArrayHelper::map(\backend\modules\postmanager\models\PostCategory::find()->where(['status' => 1])->all(), 'id', 'name')
        ],
        'published_at:datetime',
        [
            'attribute' => 'status',
            'format' => 'status',
            'filter' => [
                '0' => Yii::t('site', 'Inactive'),
                '1' => Yii::t('site', 'Active')
            ]
        ],

        [
            'attribute' => 'largeImage',
            'label' => Yii::t('app', 'Image'),
            'format' => ['image', ['width' => '50px', 'height' => '40px']],
        ],
        [
            'attribute' => 'smallImage',
            'label' => Yii::t('app', 'Small Image'),
            'format' => ['image', ['width' => '50px', 'height' => '40px']],
        ],
        'actionColumn' => [
            'dropdown' => false
        ],
    ],
]); ?>
    