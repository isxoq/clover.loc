<?php

/** @var \soft\web\View $this */
/** @var \backend\models\Brand[] $brands */

$this->title = Yii::t('app', 'About us');
$this->params['bodyClass'] = 'about-us';

$this->registerJsFile('@web/template/riode/vendor/jquery.count-to/jquery.count-to.min.js', [

    'depends' => 'yii\web\JqueryAsset',

]);

//$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;

$acf = Yii::$app->acf;

?>

    <div class="page-header pl-4 pr-4" style="background-image: url('/template/riode/images/about-us.jpg')">
        <h3 class="page-subtitle font-weight-bold">Welcome Riode</h3>
        <h1 class="page-title font-weight-bold lh-1 text-white text-capitalize">Our Services</h1>
        <p class="page-desc text-white mb-0">Lorem quis bibendum auctor, nisi elit consequat ipsum,<br> nec
            sagittis sem nibh id elit.</p>
    </div>
    <div class="page-content mt-10 pt-10">

        <?= $acf->getValue('about_us_section_1') ?>
        <?= $acf->getValue('about_us_section_2') ?>
        <?= $acf->getValue('about_us_section_3') ?>


        <!-- End Store-section -->

        <section class="brand-section grey-section pt-10 pb-10 appear-animate">
            <div class="container mt-8 mb-10">
                <h5 class="section-subtitle lh-2 ls-md font-weight-normal mb-1 text-center">04. Our Clients</h5>
                <h3 class="section-title lh-1 font-weight-bold text-center mb-5">Popular Brands</h3>
                <div class="owl-carousel owl-theme row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2"
                     data-owl-options="{
                            'nav': false,
                            'dots': false,
                            'autoplay': true,
                            'margin': 20,
                            'responsive': {
                                '0': {
                                    'items': 2
                                },
                                '576': {
                                    'items': 3
                                },
                                '768': {
                                    'items': 4
                                },
                                '992': {
                                    'items': 5
                                },
                                '1200': {
                                    'items': 6
                                }
                            }
                        }">
                    <?php foreach ($brands as $brand):?>
                    <figure class="brand-wrap bg-white banner-radius">
                        <img src="<?=$brand->imageUrl?>" alt="Brand" width="180" height="100"/>
                    </figure>
                    <?php endforeach;?>
                </div>
            </div>
        </section>

        <section class="team-section pt-8 mt-10 pb-10 mb-6 appear-animate">
            <div class="container">
                <h5 class="section-subtitle lh-2 ls-md font-weight-normal mb-1 text-center">04. Our Leaders</h5>
                <h3 class="section-title lh-1 font-weight-bold text-center mb-5">Meet our team</h3>
                <div class="row cols-sm-2 cols-md-4">
                    <div class="member appear-animate" data-animation-options="{'name': 'fadeInLeftShorter'}">
                        <figure class="banner-radius">
                            <img src="images/subpages/team1.jpg" alt="team member" width="280" height="280"
                                 style="background-color: #EEE;">
                            <div class="overlay social-links">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </figure>
                        <h4 class="member-name">Tomasz Treflerzan</h4>
                        <h5 class="member-job">Ceo / Founder</h5>
                    </div>
                    <div class="member appear-animate"
                         data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.3s'}">
                        <figure class="banner-radius">
                            <img src="images/subpages/team2.jpg" alt="team member" width="280" height="280"
                                 style="background-color: #121A1F;">
                            <div class="overlay social-links">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </figure>
                        <h4 class="member-name">Dylan Chavez</h4>
                        <h5 class="member-job">Support manager / founder</h5>
                    </div>
                    <div class="member appear-animate"
                         data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.4s'}">
                        <figure class="banner-radius">
                            <img src="images/subpages/team3.jpg" alt="team member" width="280" height="280"
                                 style="background-color: #E8E7E3;">
                            <div class="overlay social-links">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </figure>
                        <h4 class="member-name">Viktoriia Demianenko</h4>
                        <h5 class="member-job">Designer</h5>
                    </div>
                    <div class="member appear-animate"
                         data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.5s'}">
                        <figure class="banner-radius">
                            <img src="images/subpages/team4.jpg" alt="team member" width="280" height="280"
                                 style="background-color: #465D7F;">
                            <div class="overlay social-links">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </figure>
                        <h4 class="member-name">Mikhail Hnatuk</h4>
                        <h5 class="member-job">Support</h5>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Team Section -->
    </div>
