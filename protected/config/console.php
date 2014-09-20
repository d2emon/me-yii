<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Merchant Empires',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=me',
            'emulatePrepare' => true,
            'username' => 'me',
            'password' => 'e3sM6nJP4bH8pGcQ',
            'charset' => 'utf8',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);