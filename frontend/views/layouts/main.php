<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use soft\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

\frontend\assets\RiodeAsset::register($this);
//\frontend\assets\ToastAsset::register($this);

$bodyClass = ArrayHelper::getValue($this->params, 'bodyClass');
$mainClass = ArrayHelper::getValue($this->params, 'mainClass');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="google-site-verification" content="Qcyyv3SRWPQhfM1Q56zPR9Et5A0yv43kdjEq1CZdXUU" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/template/riode/images/icons/favicon.png">

    <script>
        WebFontConfig = {
            google: {families: ['Poppins:400,500,600,700,800']}
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '/template/riode/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>


    <?php $this->head() ?>
</head>
<body class="<?= $bodyClass ?>">
<?php $this->beginBody() ?>
<div class="page-wrapper">
    <h1 class="d-none">Riode - Responsive eCommerce HTML Template</h1>
    <?= $this->render('header/header_index'); ?>
    <main class="main <?= $mainClass ?>">
        <nav class="breadcrumb-nav <?=Yii::$app->controller->route == 'post/detail' ? 'mt-0 mt-lg-3':''?>">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'options' => ['class' => 'breadcrumb'],
                    'homeLink' => [
                        'label' => "<i class='d-icon-home'></i>",
                        'url' => ['site/index'],
                        'encode' => false,

                    ],
                    'links' => $this->params['breadcrumbs'] ?? [],
                ]) ?>
            </div>
        </nav>
        <?= $content ?>
    </main>
    <?= $this->render('footer/_footer'); ?>
    <?= $this->render('footer/sticky_footer'); ?>
    <?= $this->render('footer/scroll_top'); ?>
    <?= $this->render('footer/mobile_menu'); ?>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
