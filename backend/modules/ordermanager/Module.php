<?php

namespace backend\modules\ordermanager;

/**
 * ordermanager module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\ordermanager\controllers';
    public $defaultRoute = "order/index";

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
