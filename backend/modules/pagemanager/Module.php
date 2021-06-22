<?php

namespace backend\modules\pagemanager;

/**
 * pagemanager module definition class
 */
class Module extends \yii\base\Module
{

    public $defaultRoute = 'page';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\pagemanager\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
