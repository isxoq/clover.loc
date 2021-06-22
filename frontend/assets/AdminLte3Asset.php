<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class AdminLte3Asset extends AssetBundle
{

    public $css = [

        'custom.css',

    ];

    public $baseUrl = '@homeUrl/template/adminlte3/';

    public $js = [

        'base-assets/js/adminlte.min.js',
        'base-assets/js/demo.js',
        'custom.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\YiiAsset',
    ];

}
