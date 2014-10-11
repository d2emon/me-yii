<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('user',              'protected/vendor/mishamx/yii-user');
Yii::setPathOfAlias('sass',              'protected/vendor/artem-frolov/yii-sass');
Yii::setPathOfAlias('yii-debug-toolbar', 'protected/vendor/malyshev/yii-debug-toolbar');
Yii::setPathOfAlias('twig-renderer',     'protected/vendor/yiiext/twig-renderer');
Yii::setPathOfAlias('twig',              'protected/vendor/twig/twig');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Merchant Empires',
    'theme'=>'basic',

    'preload'=>['log'],

    'import'=>[
        'application.models.*',
        'application.components.*',
        'ext.mail.*',
    ],

    'modules'=>[
        'gii'=>[
            'class'=>'system.gii.GiiModule',
            'password'=>'E1kCH6BP',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            //'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>[
                'bootstrap.gii',
            ],
        ],
        'user'=>[
            'class'=>'user.UserModule',

            # encrypting method (php hash function)
            'hash' => 'md5',

            # send activation email
            'sendActivationMail' => true,

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,

            # automatically login from registration
            'autoLogin' => false,

            'registrationUrl' => ['/user/registration'],
            'recoveryUrl'     => ['/user/recovery'],
            'loginUrl'        => ['/user/login'],
            'returnUrl'       => ['/user/profile'],
            'returnLogoutUrl' => ['/user/login'],

            'tableUsers'         => 'users',
            'tableProfiles'      => 'user_profiles',
            'tableProfileFields' => 'user_profile_fields',
        ],
    ],

    'components'=>[
        'user'=>[
            // 'loginUrl'=>'user/login',
            // 'allowAutoLogin'=>true,
            'class'=>'user.components.WebUser',
        ],
        'urlManager'=>[
            'urlFormat'=>'path',
            'rules'=>[
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
            'showScriptName' => false,
        ],
		'db'=>require(dirname(__FILE__).'/database.php'),
        'errorHandler'=>[
            'errorAction'=>'site/error',
        ],
        'log'=>[
            'class'=>'CLogRouter',
            'routes'=>[
                [
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, trace',
                ],
                [
                    'class'=>'yii-debug-toolbar.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'enabled'=>YII_DEBUG,
                    'levels'=>'error, warning, trace, profile, info',
                ]
            ],
        ],
        'sass'=>[
            'class'=>'sass.SassHandler',
            'enableCompass'=>true,
        ],
        'bootstrap'=>[
            'class'=>'ext.bootstrap.components.Bootstrap',
        ],
        'mail'=>[
            'class'=>'ext.mail.YiiMail',
            'transportType'=>'php',
            'viewPath'=>'application.views.mail',
            'logging'=>true,
            'dryRun'=>false,
        ],
        'viewRenderer' => [
            'class' => 'application.vendor.yiiext.twig-renderer.ETwigViewRenderer',
            'twigPathAlias' => 'application.vendor.twig.twig.lib.Twig',

            'fileExtension' => '.twig',
            'globals' => [
                'html' => 'CHtml',
                'yii'  => 'Yii',
            ],
            'functions' => [
                'rot13' => 'str_rot13',
            ],
            'filters' => [
                'jencode' => 'CJSON::encode',
                'alias'   => 'Yii::getPathOfAlias',
            ],
        ],
	],
    'params'=>[
        'adminEmail'=>'d2emonium@gmail.com',
    ],
];
