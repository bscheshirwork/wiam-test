<?php

use app\modules\api\ApiModule as ApiModule;
use yii\caching\FileCache;
use yii\log\FileTarget;
use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$queue = require __DIR__ . '/queueComponent.php';

return [
    'id' => 'wiam-test',
    'basePath' => dirname(__DIR__),
    'runtimePath' => '@app/var',
    'language' => 'ru',
    'bootstrap' => [
        'log',
        'api',
    ],
    'params' => $params,
    'modules' => [
        'api' => ApiModule::class,
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '',
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class,
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'db' => $db,
        'queue' => $queue,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error'],
                    'logFile' => '@runtime/log/error.log',
                ],
            ],
        ],
        'cache' => [
            'class' => FileCache::class,
            'cachePath' => '@runtime/cache',
        ],
    ],
];
