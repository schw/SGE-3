<?php
use \kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name'=>'SGE - Sistema de Gestão de Eventos',
    'language'=>'pt_br',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ix4Ex7vJi9vOXbJMZZdHaRMgom0W3RkV',
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
            'viewPath' => '@app/mail',
            //'class' => 'nickcv\mandrill\Mailer',
            //'apikey' => 'JyGzSha5VEKJCw9u5Gy5Rg',
            //'useMandrillTemplates' => false,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                 'class' => 'Swift_SmtpTransport',
                 'host' => 'mail.gmx.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                 'username' => 'sge.icomp@gmx.com',
                 'password' => 'sgeicomp',
                 'port' => '465', // Port 25 is a very common port too
                 'encryption' => 'ssl', // It is often used, check your provider or mail server specs
            ],
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
    'modules' => [
   'datecontrol' =>  [
        'class' => 'kartik\datecontrol\Module',
 
        // format settings for displaying each date attribute (ICU format example)
        'displaySettings' => [
            Module::FORMAT_DATE => 'd-M-Y',
            Module::FORMAT_TIME => 'H:mm',
            Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a', 
        ],
        
        // format settings for saving each date attribute (PHP format example)
        'saveSettings' => [
            Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
            Module::FORMAT_TIME => '',
            Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
        ],
 
        // set your display timezone
        'displayTimezone' => 'America/Caracas',
 
        // set your timezone for date saved to db
        'saveTimezone' => 'America/Caracas',
        
        // automatically use kartik\widgets for each of the above formats
        'autoWidget' => true,
 
        // default settings for each widget from kartik\widgets used when autoWidget is true
        'autoWidgetSettings' => [
            Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
            Module::FORMAT_DATETIME => [], // setup if needed
            Module::FORMAT_TIME => [], // setup if needed
        ],
        
        // custom widget settings that will be used to render the date input instead of kartik\widgets,
        // this will be used when autoWidget is set to false at module or widget level.
        'widgetSettings' => [
            Module::FORMAT_DATE => [
                'class' => 'yii\jui\DatePicker', // example
                'options' => [
                    'dateFormat' => 'php:d-M-Y',
                    'options' => ['class'=>'form-control'],
                ]
            ]
        ]
        // other settings
    ],
	  'social' => [
    	// the module class
    	'class' => 'kartik\social\Module',
    		
		// the global settings for the facebook plugins widget
    	'facebook' => [
    		'appId' => 'FACEBOOK_APP_ID',
    		'secret' => 'FACEBOOK_APP_SECRET',
    		],
    	'google' => [
    		'pageId' => 'GOOGLE_PLUS_PAGE_ID',
    		'clientId' => 'GOOGLE_API_CLIENT_ID',
    	],
    	'twitter' => [
    		'screenName' => 'TWITTER_SCREEN_NAME'
    	],
      ],
	],
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
