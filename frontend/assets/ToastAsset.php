<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class ToastAsset extends AssetBundle
{

    public $sourcePath = '@frontend/web/plugin/toast';

    public $css = [
      'toast.min.css'
    ];

    public $js = [
      'toast.js'
    ];

}