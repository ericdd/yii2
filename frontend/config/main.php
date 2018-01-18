<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
   // 'layout' => 'main',   //也可以在控制器中定义
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
            ],
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',     // 设置文件缓存
//            'class' => 'yii\redis\Cache',           // 如果使用redis, cachePath要注释掉
//            'cachePath' => '@runtime/cache2',       //缓存目录 frontend/runtime/cache2，可任意删除
            'keyPrefix' => 'yi_',                // 唯一键前缀，生成一个yi目录
        ],
    ],

    'modules' => [
        'admin' => [
            'defaultRoute' => 'index',          // 设置module的默认控制器
            'layout' => '../main2',          // 指定module admin的layout模版
            'class' => 'app\modules\admin\Module',
        ],
        'demo' => [
//            'defaultRoute' => 'default',
            'class' => 'app\modules\demo\Module',
        ],
    ],

    'params' => $params,
];
