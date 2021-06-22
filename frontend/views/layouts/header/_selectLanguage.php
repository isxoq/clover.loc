<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$langs = Yii::$app->params['languages'];
$lang = Yii::$app->language;
$currentLangLabel = ArrayHelper::remove($langs, $lang);

?>

<!-- End DropDown Menu -->
<div class="dropdown language-dropdown ls-normal">

    <a><?= $currentLangLabel ?></a>
    <ul class="dropdown-box">
        <?php foreach ($langs as $key => $language): ?>
            <li>
                <a href="<?=Url::current(['lang' => $key]);?>">
                    <?= $language ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- End DropDown Menu -->
            