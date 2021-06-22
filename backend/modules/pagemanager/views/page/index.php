<?php
/*
 * @author Shukurullo Odilov
 * @date 18.05.2021, 14:24
 */

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\pagemanager\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sahifalar';
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
<?= \soft\grid\GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

    'toolbarButtons' => [
        'create' => [
            'modal' => false,
        ]
    ],

    'cols' => [
        'title_ru',
        'title_uz',
        'slug',
        'created_at',
        'updated_at',
        'image',
        //'status',
        'actionColumn' => [

        ],
    ],
]); ?>
    