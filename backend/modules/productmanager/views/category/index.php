<?php

use kartik\tree\TreeView;
use backend\modules\productmanager\models\Category;
use kartik\tree\Module;

/* @var $this \soft\web\View */
$this->title = Yii::t('app','Categories');
$this->registerCss("
    
    .kv-tree li {
        line-height: normal;
        font-size: 14px;
    }

");

echo TreeView::widget([
    // single query fetch to render the tree
    // use the Product model you have in the previous step
    'query' => Category::find(),
    'headingOptions' => ['label' => 'Kategoriyalar'],
    'fontAwesome' => true,     // optional
    'isAdmin' => false,         // optional (toggle to enable admin mode)
    'displayValue' => 1,        // initial display value
    'softDelete' => false,       // defaults to true
    'cacheSettings' => [
        'enableCache' => true   // defaults to true
    ],

    'nodeView' => '@backend/modules/productmanager/views/category/_treeView',
    'showIDAttribute' => false,
    'showNameAttribute' => false,
    'nodeAddlViews' => [
        Module::VIEW_PART_2 => '@backend/modules/productmanager/views/category/_treeViewPart2',
    ],

    'nodeLabel' => function ($node) {
        return $node->title;
    },

    'mainTemplate' => '
        <div class="row">
            <div class="col-sm-4">
                {wrapper}
            </div>
            <div class="col-sm-8">
                {detail}
            </div>
        </div>',

]);

?>



