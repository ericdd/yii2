<?php

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'test',          // 设置默认控制器
    'controllerNamespace' => 'frontend\controllers\admin',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'enableStrictParsing' => false,
            'suffix' => '',
            'rules' => [
                'admin/<controller:\w+>/<action:\w+>' => 'Admin/<controller>/<action>',
//                '/blogs' => '/blog/index',
                // '/blogs/<id:\d+>' => '/blog/view',
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                //	"<controller:\w+>/<action:\w+>" => "<controller>/<action>",
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
];
