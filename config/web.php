<?php

use app\modules\api\ApiModule as ApiModule;
use yii\caching\FileCache;
use yii\log\FileTarget;
use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$queue = require __DIR__ . '/queueComponent.php';
$commonParts = require __DIR__ . '/common.php';

return [
    'id' => 'wiam-test',
    'basePath' => dirname(__DIR__),
    'runtimePath' => '@app/var',
    'language' => 'ru',
    'bootstrap' => [
        'log',
        'api',
        ...$commonParts['bootstrap'],
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
                'requests' => 'api/v1/request',
                'processor' => 'api/v1/processor',
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
