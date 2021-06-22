<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['gii'],
    'language' => 'uz',
    'timeZone' => 'Asia/Tashkent',
    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@common/rbac/items.php',
            'assignmentFile' => '@common/rbac/assignments.php',
            'ruleFile' => '@common/rbac/rules.php'

        ],

        'i18n' => [
            'translations' => [
                'site*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@soft/i18n/messages',
                    'fileMap' => [
                        'site' => 'site.php',
                    ],
                ],

                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
                'file-input*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => dirname(__FILE__) . '/../vendor/2amigos/yii2-file-input-widget/src/messages/',
                ],
            ],
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache'
        ],
        'view' => [
            'class' => 'soft\web\View',
        ],
        'site' => [
            'class' => 'soft\components\Site',
        ],

        'help' => [
            'class' => 'soft\helpers\SiteHelper',
        ],

        'formatter' => [
            'class' => 'soft\i18n\Formatter',
        ],

        'acf' => [
            'class' => 'backend\modules\acf\components\Acf',
            'fileBasePath' => '@frontend/web/uploads/acf',
            'fileBaseUrl' => '/uploads/acf',
        ]
    ],
    'modules' => [

        'treemanager' => [
            'class' => '\kartik\tree\Module',
            'dataStructure' => [
                'nameAttribute' => 'title'
            ]
        ],

        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'softModel' => [
                    'class' => 'soft\gii\generators\model\Generator',
                ],
                'softAjaxCrud' => [
                    'class' => 'soft\gii\generators\crud\Generator',
                ],
            ]
        ]

    ]
];
