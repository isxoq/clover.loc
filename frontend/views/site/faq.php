<?php

/** @var \soft\web\View $this */
/** @var \backend\models\FaqType[] $faq_types */

$this->title = 'Faq';

$this->addBreadCrumb($this->title);
?>
<div class="page-header" style="background-image: url('/template//riode/images/faq.jpg')">
    <h3 class="page-subtitle lh-1">Frequently</h3>
    <h1 class="page-title font-weight-bold text-capitalize lh-1">Asked Questions</h1>
</div>
<div class="page-content mb-10 pb-8">
    <section>
        <div class="container">
            <div class="row">
                <?php foreach ($faq_types as $key=>$type):?>
                    <div class="col-md-6 mt-10">
                        <h2 class="title pl-2 pr-2 ls-m text-left"><?=$type->name;?></h2>
                        <div class="accordion accordion-border accordion-boxed accordion-plus">
                            <?php foreach ($type->faqs as $key1 => $faq):?>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#collapse2-<?=$key1+1?>" class="<?= ($key1+1) == 1 ? 'collapse':'expand'?>"><?=$faq->question?></a>
                                    </div>
                                    <div id="collapse2-<?=$key1+1?>" class="<?=($key1+1) == 1 ? 'expanded' : 'collapsed'?>">
                                        <div class="card-body">
                                            <p><?=Yii::$app->formatter->asHtml($faq->asked)?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>

</div>
