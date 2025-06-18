<?php

declare(strict_types=1);

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

defined('BASE_DIR') || define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        BASE_DIR . '/bin',
        BASE_DIR . '/bootstraps',
        BASE_DIR . '/config',
        BASE_DIR . '/contracts',
        BASE_DIR . '/models',
        BASE_DIR . '/modules',
        BASE_DIR . '/services',
    ]);

    $rectorConfig->cacheDirectory(BASE_DIR . '/var/cache/.rector_cache');

    $rectorConfig->cacheClass(FileCacheStorage::class);

    //    $rectorConfig->disableParallel(); // https://getrector.com/documentation/troubleshooting-parallel
    $rectorConfig->parallel(240, 16, 10);

    $rectorConfig->bootstrapFiles([
        BASE_DIR . '/vendor/yiisoft/yii2/Yii.php',
    ]);

    $rectorConfig->importNames();

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::PRIVATIZATION,
        SetList::TYPE_DECLARATION,
    ]);
};
