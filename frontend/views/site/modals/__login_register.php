<?php
/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/5/2021
 * Time: 11:59 AM
 * Project name shop
 */

?>
<div class="login-popup">
    <div class="form-box">
        <div class="tab tab-nav-simple tab-nav-boxed form-tab">
            <ul class="nav nav-tabs nav-fill align-items-center border-no justify-content-center mb-5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active border-no lh-1 ls-normal" href="#signin"><?= t('Login') ?></a>
                </li>
                <li class="delimiter"><?=t('or')?></li>
                <li class="nav-item">
                    <a class="nav-link border-no lh-1 ls-normal" href="#register"><?= t('Register') ?></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="signin">
                    <form action="#">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="singin-email" name="singin-email"
                                   placeholder="<?= t('Phone number') ?>" required/>
                        </div>
                        <div class="form-footer">
                            <div class="form-checkbox">
                                <input type="checkbox" class="custom-checkbox" id="signin-remember"
                                       name="signin-remember"/>
                                <label class="form-control-label" for="signin-remember"><?= t('Remember me') ?></label>
                            </div>
                            <a href="#" class="lost-link"><?= t('Forget password') ?></a>
                        </div>
                        <button class="btn btn-dark btn-block btn-rounded" type="submit">Login</button>
                    </form>
                    <div class="form-choice text-center">
                        <label class="ls-m">or Login With</label>
                        <div class="social-links">
                            <a href="#" class="social-link social-google fab fa-google border-no"></a>
                            <a href="#" class="social-link social-facebook fab fa-facebook-f border-no"></a>
                            <a href="#" class="social-link social-twitter fab fa-twitter border-no"></a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="register">
                    <form action="#">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="singin-email" name="singin-email"
                                   placeholder="<?= t('Phone number') ?>" required/>
                        </div>
                        <div class="form-footer">
                            <div class="form-checkbox">
                                <input type="checkbox" class="custom-checkbox" id="register-agree" name="register-agree"
                                       required/>
                                <label class="form-control-label" for="register-agree"><?= t('I agree') ?></label>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-block btn-rounded" type="submit"><?= t('Register') ?></button>
                    </form>
                    <div class="form-choice text-center">
                        <label class="ls-m"><?= t('or Register With') ?></label>
                        <div class="social-links">
                            <a href="#" class="social-link social-google fab fa-google border-no"></a>
                            <a href="#" class="social-link social-facebook fab fa-facebook-f border-no"></a>
                            <a href="#" class="social-link social-twitter fab fa-twitter border-no"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>