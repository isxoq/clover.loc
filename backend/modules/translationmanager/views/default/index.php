<?php/** @var soft\web\View $this *//** @var yii\data\ActiveDataProvider $dataProvider *//** @var backend\modules\translationmanager\models\SourceMessageSearch $searchModel */$this->title = "Tarjimalar";$this->params['breadcrumbs'][] = $this->title;$this->registerAjaxCrudAssets();?><p>    <?= a('Import', ['default/sync', 'import' => 1], ['class' => 'btn btn-primary'], 'arrow-down') ?>    <?= a('Export', ['default/sync', 'export' => 1], ['class' => 'btn btn-primary'], 'arrow-up') ?>    <?= a(fa('arrow-down') . ' Import and ' . fa('arrow-up') . ' Export', ['default/sync', 'import' => 2, 'export' => 1], ['class' => 'btn btn-primary']) ?>    <?= a(fa('arrow-up') . ' Export and  ' . fa('arrow-down') . ' Import', ['default/sync', 'import' => 1, 'export' => 2], ['class' => 'btn btn-primary']) ?></p><p>    Last imported:    <b><?= Yii::$app->formatter->asDateTimeUz(\backend\modules\translationmanager\models\sync\MessageCategoryLocal::lastImportedTime()) ?></b>    <br>    Last exported:    <b><?= Yii::$app->formatter->asDateTimeUz(\backend\modules\translationmanager\models\sync\MessageCategoryLocal::lastExportedTime()) ?></b></p><?= \soft\grid\GridView::widget([    'id' => 'crud-datatable',    'pjax' => true,    'panel' => [        'heading' => $this->title,    ],    'toolbarButtons' => [        'create' => [            'modal' => true,        ]    ],    'bulkButtonsTemplate' => '{delete}',    'condensed' => true,    'dataProvider' => $dataProvider,    'filterModel' => $searchModel,    'cols' => Yii::$app->getModule('translate-manager')->getGridColumns($searchModel),]); ?>