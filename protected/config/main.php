<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Merchant Empires',

	'preload'=>['log'],

	'import'=>[
		'application.models.*',
		'application.components.*',
        'ext.mail.YiiMailMessage',
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
	],

    'aliases' => [
        'vendor' => dirname(__FILE__).'/../../vendor',
    ],

	'components'=>[
		'user'=>[
            'loginUrl'=>'user/login',
			'allowAutoLogin'=>true,
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
		'db'=>[
			'connectionString' => 'mysql:host=localhost;dbname=me',
			'emulatePrepare' => true,
			'username' => 'me',
			'password' => 'e3sM6nJP4bH8pGcQ',
			'charset' => 'utf8',
		],
		'errorHandler'=>[
			'errorAction'=>'site/error',
		],
		'log'=>[
			'class'=>'CLogRouter',
			'routes'=>[
				[
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
				],
			],
		],
        'sass'=>[
            'class'=>'vendor.artem-frolov.yii-sass.SassHandler',
            'enableCompass'=>true,
        ],
        'bootstrap'=>[
            'class'=>'bootstrap.components.Bootstrap',
        ],
        'mail'=>[
            'class'=>'ext.mail.YiiMail',
            'transportType'=>'php',
            'viewPath'=>'application.views.mail',
            'logging'=>true,
            'dryRun'=>false,
        ]
    ],
	'params'=>[
		'adminEmail'=>'d2emonium@gmail.com',
	],
];
