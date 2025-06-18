<?php

declare(strict_types=1);

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Strict\Rector\BooleanNot\BooleanInBooleanNotRuleFixerRector;
use Rector\Strict\Rector\If_\BooleanInIfConditionRuleFixerRector;
use Rector\Strict\Rector\Ternary\BooleanInTernaryOperatorRuleFixerRector;
use Rector\TypeDeclaration\Rector\BooleanAnd\BinaryOpNullableToInstanceofRector;
use Rector\TypeDeclaration\Rector\While_\WhileNullableToInstanceofRector;

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


    $rectorConfig->skip([
        BinaryOpNullableToInstanceofRector::class, //SetList::INSTANCEOF - усложнение
        FlipTypeControlToUseExclusiveTypeRector::class, //SetList::INSTANCEOF - усложнение
        WhileNullableToInstanceofRector::class, //SetList::INSTANCEOF - усложнение
        BooleanInBooleanNotRuleFixerRector::class, //SetList::STRICT_BOOLEANS - усложнения
        BooleanInIfConditionRuleFixerRector::class, //SetList::STRICT_BOOLEANS - усложнения
        BooleanInTernaryOperatorRuleFixerRector::class, //SetList::STRICT_BOOLEANS - усложнения
        EncapsedStringsToSprintfRector::class, // SetList::CODING_STYLE - менее очевидные шаблоны, просто шум
        SimplifyEmptyCheckOnEmptyArrayRector::class,//SetList::CODE_QUALITY - одновременно с null и empty
        SimplifyIfReturnBoolRector::class,//SetList::CODE_QUALITY - визуальное усложнение
        CombineIfRector::class, //SetList::CODE_QUALITY - визуальное усложнение
    ]);
};
