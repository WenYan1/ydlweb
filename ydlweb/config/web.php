<?php

$params = require(__DIR__ . '/params.php');
Yii::$classMap['Salt'] = '@app/libs/Salt.php';
Yii::$classMap['Tool'] = '@app/libs/Tool.php';
Yii::$classMap['Upload'] = '@app/libs/Upload.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'ydlbam' => [
            'class' => 'app\modules\ydlbam\Module',
            ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'eDlntdz6CmwFGCiXvKwI4-ZuBJuP4TPX',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
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
            'useFileTransport' => false,
            'transport' => [
               'class' => 'Swift_SmtpTransport',
               //'host' => 'smtp.exmail.qq.com',  //每种邮箱的host配置不一样
			   'host' => 'email.tempus.cn',
			  
               //'username' => 'service@beforeship.com',
			   'username' => 'TempusHoldITAlert@tempus.cn',
			   
               //'password' => '7ByZ9xnCHUcRfy',
			   'password' => 'tempus.oa',
               'port' => '25',
               'encryption' => 'tls',

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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' =>  'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
