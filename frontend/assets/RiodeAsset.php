<?php
/*
 * @author Shukurullo Odilov
 * @link telegram: https://t.me/yii2_dasturchi
 * @date 20.05.2021, 16:31
 */


namespace frontend\assets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;
use yii\web\View;

class RiodeAsset extends AssetBundle
{

//    public $sourcePath = '@frontend/web/template/riode';
    public $basePath = '@webroot';
    public $baseUrl = '@web/template/riode';
    public $css = [

        "vendor/fontawesome-free/css/all.min.css",
        "vendor/animate/animate.min.css",
        "vendor/magnific-popup/magnific-popup.min.css",
        "vendor/owl-carousel/owl.carousel.min.css",
    ];
    public $js = [

        "vendor/elevatezoom/jquery.elevatezoom.min.js",
        "vendor/magnific-popup/jquery.magnific-popup.min.js",

        "vendor/owl-carousel/owl.carousel.min.js",
        "vendor/imagesloaded/imagesloaded.pkgd.min.js",
        "vendor/isotope/isotope.pkgd.min.js",

    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'frontend\assets\ToastAsset',
    ];

    public function init()
    {
        parent::init();
        $this->normaliseCssFiles();
        $this->normalizeJsFiles();
    }

    /**
     * @throws \Exception
     */
    private function normaliseCssFiles()
    {
        $cssFiles = ArrayHelper::getValue(Yii::$app->view->params, 'cssFiles', []);
        $this->addCss($cssFiles);

        $route = Yii::$app->controller->route;

        $demo22routes = [
            'site/index',
            'product/category'
        ];

        $mainCssFile = in_array($route, $demo22routes) ? 'css/demo22.min.css' : 'css/style.min.css';
        $this->addCss([$mainCssFile]);
        $this->addCss(['css/custom.css']);
    }

    /**
     * @throws \Exception
     */
    private function normalizeJsFiles()
    {
        $jsFiles = ArrayHelper::getValue(Yii::$app->view->params, 'jsFiles', []);
        $this->addJs($jsFiles);
        $this->addJs(["js/main.js", "js/cart.js", 'js/custom.js']);
    }

    /**
     * @param $cssFiles
     */
    private function addCss($cssFiles)
    {
        $cssFiles = (array)$cssFiles;
        $this->css = ArrayHelper::merge($this->css, $cssFiles);
    }

    /**
     * @param $jsFiles
     */
    private function addJs($jsFiles)
    {
        $jsFiles = (array)$jsFiles;
        $this->js = ArrayHelper::merge($this->js, $jsFiles);
    }

}