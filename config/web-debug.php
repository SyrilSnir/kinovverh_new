<?php

$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'ВВЕРХ',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'kinovverh',
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HUI34H5UI4HUI2H5UH34UIHUI5H3UI5HUI3HHU3UIHTTUIHTHUI3HTUI3HUHG',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
               '' => 'site/index',
             //   'adminka/<_a:[\w-]+>' => 'adminka/main/',
               [
                    'pattern' => 'kinozal',
                    'route' => 'site/index',
                    'suffix' => ''                   
                ],
                '<_c:download>/<film:[\w\-]+>' => '<_c>/index',
                 '<action:(lk|login|register|logout)>' => 'user/<action>',
                '<_c:kinozal>/<_a:(categories)>/<cat:[\w-]+>' => '<_c>/<_a>',
                '<_c:kinozal>/<_a:(znak)>/<znak:[\w\d-]+>' => '<_c>/<_a>',
                ['class' => 'app\components\url\KinozalRule'],
            //    'kinozal/<slug:[\w\-]+>' => 'kinozal/viewl',
                [
                    'pattern' => 'lk/save',
                    'route' => 'user/save',
                    'suffix' => ''
                ],                
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
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
        'db' => $db,
    ],    
    'as access' => [
        'class' => '\yii\filters\AccessControl',
        'only' => ['user/lk'],
        'rules' => [ 
            [
                'allow' => true,
                'roles' => ['@']
            ]
        ]
    ],    
    'modules' => [
            'adminka' => [
                'class' => 'app\modules\adminka\Module',
                'layout' => 'main',
                'defaultRoute' => 'main/index',
            ]
        ]    
    
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
