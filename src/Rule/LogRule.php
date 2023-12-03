<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespace;

final class LogRule extends Rule
{
    public static function uniformNamingForLogger(): ArchRule
    {
        return self::uniformNaming('Logger');
    }

    public static function normalizerMustBeLoggable(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Normalizer'))
            ->should(new DependsOnTheseNamespace('Psr\Log\LoggerInterface'))
            ->because('Normalizer must have dependency on LoggerInterface');
    }

    public static function listenerMustBeLoggable(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Listener'))
            ->should(new DependsOnTheseNamespace('Psr\Log\LoggerInterface'))
            ->because('Listener must have dependency on LoggerInterface');
    }

    public static function loggerMustDependOnLoggerInterface(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Logger'))
            ->should(new DependsOnTheseNamespace('Psr\Log\LoggerInterface'))
            ->because('Logger must have dependency on LoggerInterface');
    }

    public static function serviceMustBeLoggable(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Service'))
            ->should(new DependsOnTheseNamespace('Psr\Log\LoggerInterface'))
            ->because('Service must have dependency on LoggerInterface');
    }

    public static function httpMustBeLoggable(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Http'))
            ->should(new DependsOnTheseNamespace('Psr\Log\LoggerInterface'))
            ->because('Http must have dependency on LoggerInterface');
    }
}
