<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>


<!-- End Header -->
    <div class="page-content">
        <section
                class="error-section d-flex flex-column justify-content-center align-items-center text-center pl-3 pr-3">
            <h1 class="mb-2 ls-m"><?= Html::encode($this->title)?></h1>
            <img src="/template/riode/images/404.png" alt="error 404" width="609" height="131">
            <h4 class="mt-7 mb-0 ls-m text-uppercase">
                <?= Html::encode($message) ?>
            </h4>
            <p class="text-grey font-primary ls-m">It looks like nothing was found at this location.</p>
            <?php if (Yii::$app->request->referrer):?>
                <a href="<?=Url::to(['/'])?>" class="btn btn-success btn-rounded mb-4">Go back</a>
            <?php endif;?>
            <a href="<?=Url::to(['/'])?>" class="btn btn-primary btn-rounded mb-4">Go home</a>
        </section>
    </div>

