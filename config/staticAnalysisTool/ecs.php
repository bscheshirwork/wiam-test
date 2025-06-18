<?php

use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

defined('BASE_DIR') || define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        BASE_DIR . '/bin',
        BASE_DIR . '/bootstraps',
        BASE_DIR . '/config',
        BASE_DIR . '/contracts',
        BASE_DIR . '/models',
        BASE_DIR . '/modules',
        BASE_DIR . '/services',
    ]);

    $ecsConfig->cacheDirectory(BASE_DIR . '/var/cache/.ecs_cache');

    $ecsConfig->cacheNamespace('app');

    $ecsConfig->sets([
        SetList::CLEAN_CODE,
        SetList::COMMON,
        SetList::PSR_12,
        SetList::SYMPLIFY,
    ]);

    $ecsConfig->ruleWithConfiguration(TrailingCommaInMultilineFixer::class, [
        'elements' => ['arrays', 'arguments', 'parameters', 'match'],
    ]);

    $ecsConfig->skip([
        DeclareStrictTypesFixer::class,
        NotOperatorWithSuccessorSpaceFixer::class, // дискуссионно, лучше видно для слепых
        LineLengthFixer::class, // убирает структуру для сокращения записи. Может быть вредно.
        MethodChainingNewlineFixer::class, // дискуссионно
    ]);
};
