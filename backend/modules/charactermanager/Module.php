<?php

namespace backend\modules\charactermanager;

/**
 * charactermanager module definition class
 */
class Module extends \yii\base\Module
{

    public $defaultRoute = 'character/index';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\charactermanager\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
