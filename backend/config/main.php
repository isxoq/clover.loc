<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'uz',
    'modules' => [

        'usermanager' => [
            'class' => 'backend\modules\usermanager\Module',
        ],

        'ordermanager' => [
            'class' => 'backend\modules\ordermanager\Module',
        ],

        'clickmanager' => [
            'class' => 'backend\modules\click\Click',
        ],

        'menumanager' => [
            'class' => 'backend\modules\menumanager\Module',
        ],

        'page-manager' => [
            'class' => 'backend\modules\pagemanager\Module',
        ],

        'postmanager' => [
            'class' => 'backend\modules\postmanager\Module',
        ],

        'translate-manager' => [
            'class' => 'backend\modules\translationmanager\TranslationManager',
        ],

        'product-manager' => [
            'class' => 'backend\modules\productmanager\Module',
        ],

        'character-manager' => [
            'class' => 'backend\modules\charactermanager\Module',
        ],

        'gridview' => [
            'class' => 'kartik\grid\Module'
        ],

        'acf' => [
            'class' => 'backend\modules\acf\Module',
            'languages' => function () {
                return Yii::$app->params['languages'];
            }
        ],

    ],
    'components' => [

        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '@homeUrl/template/adminlte3/base-assets',
                    'js' => ['js/jquery.min.js']
                ],

                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '@homeUrl/template/adminlte3/base-assets',
                    'css' => [
                        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
                        'fontawesome-free/css/all.min.css',
                        'css/adminlte.min.css',
                    ]
                ],

                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '@homeUrl/template/adminlte3/base-assets',
                    'js' => ['js/bootstrap.bundle.min.js',]
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                    'depends' => [
                        'yii\web\JqueryAsset',
                        'yii\bootstrap\BootstrapPluginAsset',
                    ]
                ],
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                ],
            ]
        ],

    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['admin'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'roots' => [
                [
                    'baseUrl' => '',
                    'basePath' => '@frontend/web',
                    'path' => 'uploads/files',
                    'name' => 'Uploads'
                ],
            ],
        ]
    ],
    'params' => $params,
];
