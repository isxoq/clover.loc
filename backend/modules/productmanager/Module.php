<?php

namespace backend\modules\productmanager;

/**
 * productmanager module definition class
 */
class Module extends \yii\base\Module
{

    public $defaultRoute = 'product/index';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\productmanager\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
