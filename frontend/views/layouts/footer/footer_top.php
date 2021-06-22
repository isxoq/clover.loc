<div class="footer-top">
    <div class="row align-items-center">
        <div class="col-lg-3">
            <a href="<?= to(['/']) ?>" class="logo-footer">
                <img src="<?= Yii::$app->acf->getValue('Logo') ?>" alt="logo-footer" width="154"
                     height="43"/>
            </a>
            <!-- End FooterLogo -->
        </div>
        <div class="col-lg-9">
            <div class="widget widget-newsletter form-wrapper form-wrapper-inline">
                <div class="newsletter-info mx-auto mr-lg-2 ml-lg-4">
                    <h4 class="widget-title"><?= t('Subscribe to our Newsletter') ?></h4>
                    <p><?= t('Get all the latest information, Sales and Offers') ?></p>
                </div>
                <form action="<?= to(['site/add-email']) ?>" method="POST" class="input-wrapper input-wrapper-inline">
                    <input type="email" class="form-control" name="email" id="email"
                           placeholder="<?= t('Email address here...') ?>" required/>
                    <button class="btn btn-primary btn-rounded btn-md ml-2" type="submit"><?= t('Subscribe') ?><i
                                class="d-icon-arrow-right"></i></button>
                </form>
            </div>
            <!-- End Newsletter -->
        </div>
    </div>
</div>
<!-- End FooterTop -->