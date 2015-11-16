<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
          'redactor' => 'yii\redactor\RedactorModule',
          
          'redactor' => [
			'class' => 'yii\redactor\RedactorModule',
			'uploadDir' => '@webroot/uploads',
			'uploadUrl' => '/uploads',
			'imageAllowExtensions'=>['jpg','png','gif']
        ],
        'admin' => [
            'class' => 'app\module\admin\AdminModule',
            'layoutPath' => '@app/module/admin/views/layouts/',
      		'layout' => 'main'
        ],
        
      ],
    
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'B2n_jXdY53WlGZQPFEGngSnydRre21Q5',
            // 'baseUrl'=> '',
        ],
       
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
	        'enableStrictParsing' => true,
	        'rules' => [
	        	 [
                    'pattern' => '',
                    'route' => 'site/index',
                    'suffix' => ''
                 ],
	        	                 
                 [
                    'pattern' => '<controller>/<action>/<slug:[\w+\-]+>',
                    'route' => '<controller>/<action>',
                    'suffix' => '.html'
                 ],
                 
                           
	            [
	                'pattern' => '<controller>/<action>/<id:\d+>',
	                'route' => '<controller>/<action>',
	                'suffix' => '.html'
	            ],
	            
	            [
	                'pattern' => '<controller>/<action>',
	                'route' => '<controller>/<action>',
	                'suffix' => ''
	            ],
	            
	           
	            
	            [
	                'pattern' => '<module>/<controller>/<action>/<id:\d+>',
	                'route' => '<module>/<controller>/<action>',
	                'suffix' => ''
	            ],
	                        
	            [
	                'pattern' => '<module>/<controller>/<action>',
	                'route' => '<module>/<controller>/<action>',
	                'suffix' => ''
	            ],
        	]
		],
        
        'cache' => [
             'class' => 'yii\caching\FileCache',
        ],
        
        
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
