<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$queue = require __DIR__ . '/queueComponent.php';

return [
    'id' => 'wiam-test-console',
    'basePath' => dirname(__DIR__),
    'runtimePath' => '@app/var',
    'bootstrap' => [
        'log',
        'queue',
    ],
    'controllerNamespace' => 'app\console\controllers',
    'aliases' => [
        '@webroot' => '@app/web',
    ],
    'components' => [
        'db' => $db,
    ],
    'params' => $params,
];
