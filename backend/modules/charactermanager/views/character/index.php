<?php

use backend\modules\charactermanager\models\Character;
use backend\modules\charactermanager\models\CharacterGroup;
use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\modules\charactermanager\models\search\CharacterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xarakteristikalar';
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
            'url' => ['create-multiple'],
        ]
    ],
    'cols' => [

        'name_uz',
        'name_ru',

        [

            'attribute' => 'group_id',
            'format' => 'raw',
            'value' => function ($model) {
                /** @var Character $model */
                return $model->group->name;
            },
            'filter' => map(CharacterGroup::getAll(), 'id', 'name'),

        ],
        [

            'attribute' => 'status',
            'format' => 'status',
            'filter' => Character::statuses(),

        ],

        'actionColumn' => [

            'dropdown' => false,
            'template' => "{update} {delete}",
            'viewOptions' => [
                'role' => 'modal-remote',
            ],
            'updateOptions' => [
                'role' => 'modal-remote',
            ],
        ],
    ],
]); ?>
