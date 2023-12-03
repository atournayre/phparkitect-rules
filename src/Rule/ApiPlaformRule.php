<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\IsNotInterface;
use Arkitect\Expression\ForClasses\IsNotTrait;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;

final class ApiPlaformRule extends Rule
{
    public static function uniformNamingForDoctrineExtension(): ArchRule
    {
        return self::uniformNaming('DoctrineExtension');
    }

    public static function doctrineExtensionShouldImplementQueryItemExtensionInterface(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\DoctrineExtension'))
            ->should(new Implement('ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface',))
            ->because('DoctrineExtension should implement ApiPlatform Doctrine QueryItemExtensionInterface');
    }

    public static function doctrineExtensionShouldImplementQueryCollectionExtensionInterface(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\DoctrineExtension'))
            ->should(new Implement('ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface',))
            ->because('DoctrineExtension should implement ApiPlatform Doctrine QueryCollectionExtensionInterface');
    }

    public static function doctrineExtensionMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\DoctrineExtension'))
            ->should(new IsFinal())
            ->because('DoctrineExtension are not meant to be extended');
    }

    public static function classImplementingProviderInterfaceShouldResideInAppState(): ArchRule
    {
        return self::allClasses()
            ->that(new Implement('ApiPlatform\State\ProviderInterface'))
            ->andThat(new IsNotInterface())
            ->andThat(new IsNotTrait())
            ->should(new ResideInOneOfTheseNamespaces(
                'App\State',
                'App\State\Provider',
            ))
            ->because('it\'s an ApiPlatform convention for Providers');
    }

    public static function classImplementingProcessorInterfaceShouldResideInAppState(): ArchRule
    {
        return self::allClasses()
            ->that(new Implement('ApiPlatform\State\ProcessorInterface'))
            ->andThat(new IsNotInterface())
            ->andThat(new IsNotTrait())
            ->should(new ResideInOneOfTheseNamespaces(
                'App\State',
                'App\State\Processor',
            ))
            ->because('it\'s an ApiPlatform convention for Processors');
    }

    public static function providersAndProcessorsShouldBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces(
                'App\State',
                'App\State\Provider',
                'App\State\Processor',
            ))
            ->should(new IsFinal())
            ->because('extending a provider should be done using the decorator pattern');
    }

    public static function uniformNamingForStateProcessor(): ArchRule
    {
        return self::uniformNaming('Processor');
    }

    public static function uniformNamingForStateProvider(): ArchRule
    {
        return self::uniformNaming('Provider');
    }
}
