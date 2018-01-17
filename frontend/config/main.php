<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site',          // 设置默认控制器
    'controllerNamespace' => 'frontend\controllers',
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
                '/blogs' => '/blog/index',
                // '/blogs/<id:\d+>' => '/blog/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
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

    'modules' => [
        'admin' => [
            'defaultRoute' => 'default',          // 设置module的默认控制器
            'class' => 'app\modules\admin\Module',
        ],
        'demo' => [
            'defaultRoute' => 'default',
            'class' => 'app\modules\demo\Module',
        ],
    ],

    'params' => $params,
];
