<?php

namespace frontend\controllers;

/**
 * Created by Isxoqjon Axmedov.
 * WEB site: https://www.ninja.uz
 * Date: 5/17/2021
 * Time: 3:00 PM
 * Project name: shop
 */

use backend\models\Brand;
use backend\models\FaqType;
use common\models\User;
use frontend\models\Auth;
use frontend\models\ResetPassword;
use soft\helpers\SiteHelper;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class AuthController extends Controller
{

    public function init()
    {
        parent::init();
        SiteHelper::setLanguage();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                    'ajax-send-phone-verify-code' => ['POST'],
                    'ajax-verify-phone-verify-code' => ['POST']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        Yii::$app->session->setFlash('data', $attributes);
        /* @var $auth Auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();
        if (Yii::$app->user->isGuest) {
            if ($auth) { // авторизация
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // регистрация
                if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Пользователь с такой электронной почтой как в {client} уже существует, но с ним не связан. Для начала войдите на сайт использую электронную почту, для того, что бы связать её.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'scenario' => User::SCENARIO_AUTH,
                        'username' => $attributes['email'],
                        'email' => $attributes['email'],
                        'type' => User::CUSTOMER,
                        'first_name' => $attributes['given_name'],
                        'last_name' => $attributes['family_name'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // Пользователь уже зарегистрирован
            if (!$auth) { // добавляем внешний сервис аутентификации
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionResendCode()
    {
        $user = User::findOne(['phone' => Yii::$app->session->get('tempPhone'), 'status' => User::TYPE_PHONE_VERIFYING]);
        if (!$user) {
            not_found();
        }

        $user->code = random_int(Yii::$app->params['user.minCodeLength'], Yii::$app->params['user.maxCodeLength']);
        $user->verify_time = time() + 120;
        $user->save();
        return $this->redirect(['auth/verify-phone']);
    }

    public function actionResendResetCode()
    {
        $user = User::findOne(['phone' => Yii::$app->session->get('tempResetPhone'), 'status' => User::STATUS_ACTIVE]);
        if (!$user) {
            not_found();
        }

        $user->code = random_int(Yii::$app->params['user.minCodeLength'], Yii::$app->params['user.maxCodeLength']);
        $user->verify_time = strtotime('+ 2 minute');
        $user->save();
        return $this->redirect(['auth/verify-reset-phone']);
    }


    public function actionSetProfileInfo()
    {
        $model = new SignupForm(['scenario' => SignupForm::SCENARIO_ENTER_INFO]);
        $user = User::findOne(['phone' => Yii::$app->session->get('tempPhone'), 'status' => User::STATUS_SET_INFO]);
//        dd($user);
        if (!$user) {
            not_found();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->endRegister()) {
                $this->redirect(['site/index']);
            }
        }

        return $this->render('setinfo', [
            'model' => $model,
        ]);
    }


    public function actionSetPassword()
    {
        $model = new ResetPassword(['scenario' => ResetPassword::SCENARIO_CHANGE]);
        $user = User::findOne(['phone' => Yii::$app->session->get('tempResetPhone'), 'status' => User::STATUS_ACTIVE]);
        if (!$user) {
            not_found();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->endRegister()) {
                $this->redirect(['site/index']);
            }
        }

        return $this->render('setpassword', [
            'model' => $model,
        ]);
    }

    public function actionVerifyPhone()
    {
        $model = new SignupForm(['scenario' => SignupForm::SCENARIO_VERIFY]);
        $user = User::findOne(['phone' => Yii::$app->session->get('tempPhone'), 'status' => User::TYPE_PHONE_VERIFYING]);

        if (!$user) {
            not_found();
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate() && $model->isNotExpired()) {

                if ($model->validateVerificationCode()) {
                    $this->redirect(['auth/set-profile-info']);
                }

            }

        }

        return $this->render('verify', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm(['scenario' => SignupForm::SCENARIO_REGISTER]);

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            $this->redirect(['auth/verify-phone']);
        } else {

        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new ResetPassword();
        $model->scenario = ResetPassword::SCENARIO_PHONE;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->saveToSession();
            $model->generateVerifyCode();
            $this->redirect(['auth/verify-reset-phone']);
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }

    public function actionVerifyResetPhone()
    {
        $model = new ResetPassword();
        $model->scenario = ResetPassword::SCENARIO_VERIFY;

        $user = User::findOne(['phone' => Yii::$app->session->get('tempResetPhone')]);

        if (!$user) {
            not_found();
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->phone = $model->getTempPhone();
            if ($model->validate() && !$model->isExpired()) {
                if ($model->validateVerificationCode()) {
                    $this->redirect(['auth/set-password']);
                }
            }
        }

        return $this->render('verifyResetCode', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionLoginAjax()
    {

        $model = new SignupForm();

        return $this->renderAjax('modals/__login_register', compact('model'));
    }


    public function actionAjaxSendPhoneVerifyCode()
    {
        $phone = Yii::$app->request->post('phone');
        Yii::$app->session->set('verify_phone', Yii::$app->help->clearPhoneNumber($phone));
        Yii::$app->session->set('verify_code', random_int(Yii::$app->params['user.minCodeLength'], Yii::$app->params['user.maxCodeLength']));

    }

    public function actionAjaxVerifyPhoneVerifyCode()
    {
        $phone = Yii::$app->help->clearPhoneNumber(Yii::$app->request->post('phone'));
        $code = Yii::$app->request->post('code');

        $session_phone = Yii::$app->session->get('verify_phone');
        $session_code = Yii::$app->session->get('verify_code');

        if ($phone == $session_phone && $code == $session_code) {

            $user = User::findOne(user('id'));
            $user->phone = $phone;
            $user->save();

            Yii::$app->session->remove('verify_phone');
            Yii::$app->session->remove('verify_code');

            return true;
        }

        return false;

    }

    public function actionAjaxResendPhoneVerifyCode()
    {

        $session_phone = Yii::$app->session->get('verify_phone');
        Yii::$app->session->set('verify_code', random_int(Yii::$app->params['user.minCodeLength'], Yii::$app->params['user.maxCodeLength']));

    }


}