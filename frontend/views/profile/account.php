<?php

use yii\helpers\Url;

/** @var \soft\web\View $this */
/** @var \frontend\models\PersonalDataForm $personalDataModel */
$this->title = t('Account');
$this->params['bodyClass'] = '';
$this->params['mainClass'] = 'account';
$this->addBreadCrumb($this->title);


?>

<div class="page-content mt-4 mb-10 pb-6">
    <div class="container">
        <h2 class="title title-center mb-10"><?= t('My account') ?></h2>
        <?php if ($this->getFlash('user_success')): ?>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="alert alert-success alert-simple alert-inline">
                        <h4 class="alert-title"><?= $this->getFlash('user_success') ?></h4>

                        <button type="button" class="btn btn-link btn-close">
                            <i class="d-icon-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php if ($this->getFlash('user_error')): ?>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="alert alert-danger alert-simple alert-inline">
                        <h4 class="alert-title"><?= $this->getFlash('user_error') ?></h4>
                        <button type="button" class="btn btn-link btn-close">
                            <i class="d-icon-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="tab tab-vertical gutter-lg">
            <ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#account"><?= t('Account details') ?></a>
                </li>
                <li class="nav-item">
                    <form action="<?= Url::to(['site/logout']) ?>" method="get">

                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                               value="<?= Yii::$app->request->csrfToken ?>">

                        <button type="submit" class="btn btn-link" style="margin-left: -15px;">
                            <?= t('Log out') ?>
                        </button>
                    </form>
                </li>
            </ul>
            <div class="tab-content col-lg-9 col-md-8">
                <div class="tab-pane active" id="dashboard">
                    <?= $this->render('_tab_dashboard') ?>
                </div>
                <div class="tab-pane" id="orders">
                    <?= $this->render('_tab_orders', [
                        'models' => $models,
                        'pages' => $pages
                    ]) ?>
                </div>

                <div class="tab-pane" id="account">
                    <?= $this->render('_tab_account', [
                        'personalDataModel' => $personalDataModel
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main -->