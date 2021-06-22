<?php

/* @var $this yii\web\View */

use \soft\widget\adminlte3\SmallBoxWidget;

$this->title = 'Online shopping center by iTeach';

?>
<div class="row">
    <div class="col col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-3 col-xs-6">
                        <?=SmallBoxWidget::widget([
                            'largeText' => 5,
                            'smallText' => t('district'),
                            'footerText' => t('district'),
                            'icon' => 'fa fa-globe',
                            'footerLink' => ['edu/district'],
                        ])?>
                    </div>

                    <div class="col-lg-3 col-xs-6">

                        <?= SmallBoxWidget::widget([
                            'type' => SmallBoxWidget::TYPE_SUCCESS,
                            'largeText' => 6,
                            'smallText' => t('edu institutions'),
                            'footerText' => t('edu institutions'),
                            'icon' => 'fa fa-university',
                            'footerLink' => ['edu/um'],
                        ]) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>