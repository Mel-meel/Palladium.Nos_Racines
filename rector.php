<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;

use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
//use Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;

return static function (RectorConfig $rectorConfig): void {    
    // Sets of rules will be applied
    $rectorConfig->sets([
        SetList::PHP_80,
        SetList::PHP_81,
        SetList::PHP_82,
        SetList::PHP_83,
        LevelSetList::UP_TO_PHP_83,

        SetList::CODE_QUALITY,
        SetList::TYPE_DECLARATION,
        SetList::CODING_STYLE,
        SetList::EARLY_RETURN,
        SetList::DEAD_CODE,

        SetList::NAMING,
        SetList::INSTANCEOF,
    ]);
    // directory & rules to ignore
    $rectorConfig->skip([
        __DIR__ . '/vendor',
        __DIR__ . '/ecs.php',  
        __DIR__ . '/tests/bootstrap.php',     
        
        ShortenElseIfRector::class,
        InlineConstructorDefaultToPropertyRector::class,
        CompleteDynamicPropertiesRector::class,
        //AddLiteralSeparatorToNumberRector::class,
        NewlineAfterStatementRector::class,
    ]);    
};
