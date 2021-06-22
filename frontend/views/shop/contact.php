<?php
/** @var boolean $message */

use soft\widget\kartik\ActiveForm;
use soft\widget\input\PhoneMaskedInput;
use yii\helpers\Html;

$this->title = Yii::t('app','Contacts');

/* @var $this \soft\web\View */
$this->addBreadCrumb($this->title);
?>

<div class="page-header" style="background-image: url('/template/riode/images/contact-us.jpg')">
    <h1 class="page-title font-weight-bold text-capitalize ls-l"><?=Yii::t('app','Contact with Us')?></h1>
</div>
<div class="page-content mt-10 pt-7">
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 ls-m mb-4">
                    <div class="grey-section d-flex align-items-center h-100">
                        <div>
                            <h4 class="mb-2 text-capitalize">Headquarters</h4>
                            <p>1600 Amphitheatre Parkway<br>New York WC1 1BA</p>

                            <h4 class="mb-2 text-capitalize">Phone Number</h4>
                            <p>
                                <a href="tel:#">1.800.458.56</a><br>
                                <a href="tel:#">1.800.458.56</a>
                            </p>

                            <h4 class="mb-2 text-capitalize">Support</h4>
                            <p class="mb-4">
                                <a href="#">support@your-domain.com</a><br>
                                <a href="#">help@your-domain.com</a><br>
                                <a href="#">Sale</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 d-flex align-items-center mb-4">
                    <div class="w-100">
                        <?php if ($m == 1): ?>
                            <div class="alert alert-simple alert-primary alert-icon mb-4">
                                <i class="fas fa-check"></i>
                                Xabaringiz qabul qilindi.Siz bilan tez orada bog'lanamiz!
                                <button type="button" class="btn btn-link btn-close">
                                    <i class="d-icon-times"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                            <h4 class="ls-m font-weight-bold">Let’s Connect</h4>
                            <p>Sizning telefon raqam va emailingiz sir tutiladi.Xato va kamchiliklar tuzatiladi.</p>
                            <?php $form = ActiveForm::begin([
                                'options' => [
                                    'class' => 'pl-lg-2'
                                ]
                            ]);?>
                            <div class="row mb-2">
                                <div class="col-md-6 mb-4">
                                    <?=$form->field($model,'title')->textInput(['class'=>'form-control','placeholder'=>'Mavzu nomi*'])->label(false)?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <?=$form->field($model,'name')->textInput(['class'=>'form-control','placeholder'=>'Ism*'])->label(false)?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <?=$form->field($model,'email')->textInput(['class'=>'form-control','placeholder'=>'E-mail*'])->label(false)?>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <?=$form->field($model,'phone')->widget(PhoneMaskedInput::className([
                                        'mask',
                                        'options' => [
                                            'class'=>'form-control',
                                        ]
                                    ]))->label(false)?>
                                </div>

                                <div class="col-12 mb-4">
                                    <?=$form->field($model,'text')->textarea(['class'=>'form-control','placeholder'=>'Matn*'])->label(false)?>
                                </div>
                            </div>
                            <?=Html::submitButton('Post Comment <i class="d-icon-arrow-right"></i>',['class'=>'btn btn-dark btn-rounded'])?>
                        <?php ActiveForm::end();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section-->

    <section class="store-section mt-6 pt-10 pb-8">
        <div class="container">
            <h2 class="title title-center mb-7 text-normal">Our store</h2>
            <div class="row cols-sm-2 cols-lg-4">
                <div class="store">
                    <figure class="banner-radius">
                        <img src="images/subpages/store-1.jpg" alt="store" width="280" height="280">
                        <h4 class="overlay-visible">New York</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mail:#">mail@newyorkriodestore.com</a>
                            <a href="tel:#">Phone: (123) 456-7890</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="store">
                    <figure class="banner-radius">
                        <img src="images/subpages/store-2.jpg" alt="store" width="280" height="280">
                        <h4 class="overlay-visible">London</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mail:#">mail@londonriodestore.com</a>
                            <a href="tel:#">Phone: (123) 456-7890</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="store">
                    <figure class="banner-radius">
                        <img src="images/subpages/store-3.jpg" alt="store" width="280" height="280">
                        <h4 class="overlay-visible">Oslo</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mail:#">mail@osloriodestore.com</a>
                            <a href="tel:#">Phone: (123) 456-7890</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="store">
                    <figure class="banner-radius">
                        <img src="images/subpages/store-4.jpg" alt="store" width="280" height="280">
                        <h4 class="overlay-visible">Stockholm</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mail:#">mail@stockholmriodestore.com</a>
                            <a href="tel:#">Phone: (123) 456-7890</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- End Store Section -->

    <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
    <div class="grey-section google-map" id="googlemaps" style="height: 386px"></div>
    <!-- End Map Section -->
</div>
