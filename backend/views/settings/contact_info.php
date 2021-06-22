<?php

use soft\helpers\Html;
use soft\widget\adminlte3\Card;

/* @var $this \soft\web\View */

$this->title = "Kontakt sozlamalar";
$this->addBreadCrumb('Sozlamalar');
$this->addBreadCrumb($this->title);

?>

<?php Card::begin()  ?>

<?= Html::beginForm() ?>

<?= Yii::$app->acf->fields(['site_phone_number', 'email_address', 'office_address', 'working_days']) ?>

<?= Html::submitButton() ?>
<?= Html::endForm() ?>

<?php Card::end()  ?>