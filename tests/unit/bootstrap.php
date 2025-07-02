<?php
/**
 * phpunit bootstrap file
 */
declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@app', dirname(dirname(__DIR__)));
Yii::setAlias('@tests', dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'tests');
