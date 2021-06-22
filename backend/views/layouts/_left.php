<?php

use yii\helpers\Url;

$menuItems = [
    ['label' => Yii::t('app', 'Home'), 'url' => ['/'], 'icon' => 'fa fa-home'],

    [
        'label' => "Sozlamalar",
        'icon' => 'cogs,fas',
        'items' => [


            [
                'label' => "Bosh sahifa sozlamalari",
                'icon' => 'home',
                'items' => [

                    ['label' => "Banner", 'url' => ['/banner'], 'icon' => 'image,far'],
                    ['label' => "Service", 'url' => ['/service'], 'icon' => 'taxi,fas'],
                    ['label' => "Banner Group", 'url' => ['/banner-group'], 'icon' => 'images,far'],


                ]

            ],
            ['label' => "Kontakt sozlamalari", 'url' => ['/settings/contact-info'],],
            ['label' => "Biz haqimizda sahifasi", 'url' => ['/settings/about-us-page']],
        ]
    ],
    [
        'label' => "Xarakteristikalar",
        'icon' => 'list',
        'items' => [
            ['label' => "Xarakter. guruhlari", 'url' => ['/character-manager/character-group']],
            ['label' => "Xarakteristikalar", 'url' => ['/character-manager/character']],
        ]
    ],
    [
        'label' => "Kategoriyalar",
        'icon' => 'list',
        'items' => [
            ['label' => "Kategoriyalar", 'url' => ['/product-manager/category/index'], 'icon' => 'list,fas'],
            ['label' => "Tavsiya etilgan kategoriyalar", 'url' => ['/recommended-category'], 'icon' => 'list,fas'],
        ]
    ],

    ['label' => "Menyular", 'url' => ['/menumanager'], 'icon' => 'globe,fas'],
    ['label' => "Mahsulotlar", 'url' => ['/product-manager'], 'icon' => 'globe,fas'],
    ['label' => "Sahifalar", 'url' => ['/page-manager/page'], 'icon' => 'file-alt,far'],

    [
        'label' => "Buyurtmalar",
        'icon' => 'copy,far',
        'items' => [
            ['label' => "Buyurtmalar", 'url' => ['/ordermanager'], 'icon' => 'shopping-cart,fas'],
            ['label' => "Loans", 'url' => ['/ordermanager/loan'], 'icon' => 'shopping-cart,fas'],
            ['label' => "Shaharlar", 'url' => ['/ordermanager/town'], 'icon' => 'list'],
        ]
    ],

    ['label' => "Mijozlar", 'url' => ['/usermanager/customer'], 'icon' => 'list,fas'],
    ['label' => "Sayt foydalanuvchilari", 'url' => ['/usermanager/user'], 'icon' => 'list,fas'],

    ['label' => "Brand", 'url' => ['/brand'], 'icon' => 'copyright,far'],
    [
        'label' => "Blog",
        'icon' => 'copy,far',
        'items' => [
            ['label' => "Post Category", 'url' => ['/postmanager/post-category'], 'icon' => 'list'],
            ['label' => "Posts", 'url' => ['/postmanager/post'], 'icon' => 'list'],
        ]
    ],
    [
        'label' => "FAQ",
        'icon' => 'question-circle',
        'items' => [
            ['label' => "FAQ Category", 'url' => ['/faq-type'], 'icon' => 'list'],
            ['label' => "FAQ", 'url' => ['/faq'], 'icon' => 'list'],
        ]
    ],
    ['label' => "Contact", 'url' => ['/contact'], 'icon' => 'envelope,fas'],


    ['label' => 'Tarjimalar', 'url' => ['/translate-manager/default/index'], 'icon' => 'globe,fas'],

    [
        'label' => "Advanced Custom Fields",
        'icon' => 'acquisitions-incorporated,fab',
        'items' => [
            ['label' => "ACF Category", 'url' => ['/acf/field-type']],
            ['label' => "ACF fields", 'url' => ['/acf/field']],
        ]
    ],

    ['label' => 'Gii', 'icon' => 'gofore,fab', 'url' => ['/gii'],],
    ['label' => 'Clear cache', 'icon' => 'umbrella', 'url' => ['/site/cache-flush']],

];


?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/']) ?>" class="brand-link">
        <img src="/template/adminlte3//img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            Online shopping
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <?=
            \soft\widget\adminlte3\Menu::widget([
                'items' => $menuItems,
            ])
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>