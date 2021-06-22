<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'modules' => [

    ],
    'components' => [

        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [

                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '464575035875-j69rffcume6ai6sp769rh3o4for967b6.apps.googleusercontent.com',
                    'clientSecret' => 'vdpE-ho7l71eLSAKXYtmIgic',
                    'returnUrl' => "http://elmarket.uz/auth/auth?authclient=google"
                ],

//                'facebook' => [
//                    'class' => 'yii\authclient\clients\Facebook',
//                    'clientId' => 'facebook_client_id',
//                    'clientSecret' => 'секретный_ключ_facebook_client',
//                ],

            ],
        ],


        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => '@frontend/web/template/riode',
//                  'baseUrl' => '@web/template/riode',
                    'js' => [
                        "vendor/jquery/jquery.min.js",
                    ]

                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [
                    ],
                    'js' => [

                    ],
                ],

            ]
        ],

        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login'],
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'class' => 'soft\web\UrlManager',
            'isMultilingual' => true,
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                '<lang:\w+>/site/index/' => 'site/index',
                '<lang:\w+>/site/error/<search>' => 'site/error',
                '<lang:\w+>/site/about/' => 'site/about',
                '<lang:\w+>/site/faq/' => 'site/faq',
                '<lang:\w+>/site/login/' => 'site/login',

                '<lang:\w+>/' => '/',
                '<lang:\w+>/product/category/<slug>' => 'product/category',
                '<lang:\w+>/product/search' => 'product/search',
                '<lang:\w+>/product/detail/<slug>' => 'product/detail',


                '<lang:\w+>/post/all/' => 'post/all',
                '<lang:\w+>/post/detail/<slug>' => 'post/detail',
                '<lang:\w+>/post/category/<slug>' => 'post/category',
                '<lang:\w+>/post/search' => 'post/search',

                '<lang:\w+>/shop/contact' => 'shop/contact',
                '<lang:\w+>/shop/view-cart/' => 'shop/view-cart',


                '<lang:\w+>/profile/wishlist/' => 'profile/wishlist',
                '<lang:\w+>/profile/account/' => 'profile/account',
                '<lang:\w+>/profile/personal/' => 'profile/personal',


                '<lang:\w+>/auth/signup/' => 'auth/signup',
                '<lang:\w+>/auth/verify-phone' => 'auth/verify-phone',
                '<lang:\w+>/auth/set-profile-info' => 'auth/set-profile-info',
                '<lang:\w+>/auth/login' => 'auth/login',
                '<lang:\w+>/auth/request-password-reset' => 'auth/request-password-reset',
                '<lang:\w+>/auth/verify-reset-phone' => 'auth/verify-reset-phone',
                '<lang:\w+>/auth/set-password' => 'auth/set-password',

                '<lang:\w+>/auth/auth' => 'auth/auth',

            ],
        ],


    ],

    'params' => $params,
];
