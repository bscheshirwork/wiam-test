<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$queue = require __DIR__ . '/queueComponent.php';
$commonParts = require __DIR__ . '/common.php';

return [
    'id' => 'wiam-test-console',
    'basePath' => dirname(__DIR__),
    'runtimePath' => '@app/var',
    'bootstrap' => [
        'log',
        'queue',
        ...$commonParts['bootstrap'],
    ],
    'controllerNamespace' => 'app\console\controllers',
    'aliases' => [
        '@webroot' => '@app/web',
    ],
    'components' => [
        'db' => $db,
        'queue' => $queue,
    ],
    'params' => $params,
];
