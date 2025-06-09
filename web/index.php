<?php

require __DIR__ . '/../vendor/autoload.php';

define('YII_DEBUG', filter_var(env('YII_DEBUG', true), FILTER_VALIDATE_BOOL));
define('YII_ENV', env('YII_ENV', 'dev'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
Yii::setAlias('@app', dirname(__DIR__));

$config = require __DIR__ . '/../config/web.php';

new yii\web\Application($config)->run();
