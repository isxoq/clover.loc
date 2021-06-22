<?php

use soft\helpers\Html;
use soft\widget\adminlte3\Card;

/* @var $this \soft\web\View */

$this->title = "Biz haqimizda sahihasi";
$this->addBreadCrumb('Sozlamalar');
$this->addBreadCrumb($this->title);


?>

<?php Card::begin()  ?>

<?= Html::beginForm() ?>


<?= Yii::$app->acf->fields(['about_us_section_1', 'about_us_section_2', 'about_us_section_3']) ?>

<?= Html::submitButton() ?>
<?= Html::endForm() ?>

<?php Card::end()  ?>