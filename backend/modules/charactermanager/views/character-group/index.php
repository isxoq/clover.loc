<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\charactermanager\models\search\CharacterGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xarakteristika guruhlari';
$this->params['breadcrumbs'][] = $this->title;
$this->registerAjaxCrudAssets();
?>
    <?= \soft\grid\GridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'cols' => [
            'name_uz',
            'name_ru',
            'charactersCount',
            'status:status',
            'actionColumn' => [
                'viewOptions' => [
                    'role' => 'modal-remote',
                ],
                'updateOptions' => [
                    'role' => 'modal-remote',
                ],
            ],
        ],
        ]); ?>
    