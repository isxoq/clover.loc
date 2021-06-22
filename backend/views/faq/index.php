<?php

use soft\helpers\Html;

/* @var $this soft\web\View */
/* @var $searchModel backend\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faqs');
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
//            'id',
            'question',
//            'asked',
            [
                'attribute' => 'faq_type_id',
                'value' => 'faqType.name',
                'label' => 'Faq type',
                'filter' => \soft\helpers\ArrayHelper::map(\backend\models\FaqType::find()->active()->all(), 'id', 'name')
            ],
            'status:status',
//            'created_at',
//            'updated_at',
            'actionColumn' => [
                'dropdown'=>false
            ],
        ],
        ]); ?>
    