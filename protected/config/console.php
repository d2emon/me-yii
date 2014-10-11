<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Merchant Empires',

	// preloading 'log' component
	'preload'=>[
        'log'
    ],

    'modules'=>[
        'user'=>[
            'class'=>'application.vendor.mishamx.yii-user.UserModule',

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

	// application components
	'components'=>[
        'db'=>require(dirname(__FILE__).'/database.php'),
        'log'=>[
            'class'=>'CLogRouter',
            'routes'=>[
                [
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ],
            ],
        ],
    ],
];
