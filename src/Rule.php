<?php

namespace Atournayre\PHPArkitect;

use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\Extend;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespaces;
use Webmozart\Assert\Assert;
use Arkitect\Rules\Rule as BaseRule;

class Rule
{
    public static function uniformNamingForApiDocumentation(): ArchRule
    {
        return self::uniformNaming('ApiDocumentation');
    }

    private static function uniformNaming(string $nameMatching): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\' . $nameMatching))
            ->should(new HaveNameMatching('*' . $nameMatching))
            ->because('Classes should have a name matching ' . $nameMatching);
    }

    public static function apiDocumentationOpenApi(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Api\\Documentation'))
            ->should(new HaveNameMatching('/OpenApi$/'))
            ->because('API Documentation should have a name with "OpenApi" inside');
    }

    public static function uniformNamingForApiResource(): ArchRule
    {
        return self::uniformNaming('ApiResource');
    }

    public static function apiResourceShouldBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\ApiResource'))
            ->should(new IsFinal())
            ->because('ApiResource are not meant to be extended');
    }

    public static function uniformNamingForCollection(): ArchRule
    {
        return self::uniformNaming('Collection');
    }

    public static function collectionDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Collection'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\\Entity',
                'Carbon\\Carbon',
                'DateTimeInterface',
                'Doctrine\\Common\\Collections\\Collection',
                'Doctrine\\Common\\Collections\\Criteria',
                'Doctrine\\Common\\Collections\\ArrayCollection',
                'Doctrine\\Common\\Collections\\ReadableCollection',
                'Doctrine\\ORM\PersistentCollection',
                Assert::class,
                'Symfony\\Contracts\\EventDispatcher\\Event'
            ))
            ->because('Collection should only depend on Entity, Carbon, DateTimeInterface, Doctrine Collection, Doctrine Criteria, Doctrine ReadableCollection, Doctrine PersistentCollection, Webmozart Assert and Symfony EventDispatcher Event');
    }

    public static function uniformNamingForCommand(): ArchRule
    {
        return self::uniformNaming('Command');
    }

    public static function commandMustUseSymfonyAsCommandAttribute(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Command'))
            ->should(new DependsOnTheseNamespaces('Symfony\\Component\\Console\\Attribute\\AsCommand'))
            ->because('Command should have dependency on AsCommand attribute from Symfony Console');
    }

    public static function commandMustExtendSymfonyCommand(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Command'))
            ->should(new DependsOnTheseNamespaces('Symfony\\Component\\Console\\Command\\Command'))
            ->because('Command should have dependency on Symfony Console Command');
    }

    public static function commandMustUseSymfonyStopwatch(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Command'))
            ->should(new DependsOnTheseNamespaces('Symfony\\Component\\Stopwatch\\Stopwatch'))
            ->because('We use Stopwatch to measure time of command execution');
    }

    public static function dtoMustNotEndWithDto(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\DTO'))
            ->should(new NotHaveNameMatching('*DTO'))
            ->because('DTO should not be suffixed by DTO');
    }

    public static function dtoMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\DTO'))
            ->should(new IsFinal())
            ->because('Extending a DTO is not a good practice');
    }

    public static function uniformNamingForContracts(): ArchRule
    {
        return self::uniformNaming('Interface');
    }

    public static function contractsDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Contracts'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\\Entity',
                'App\\Entity',
                'App\\DTO',
                'AppcontrollerMustUseSymfonRouteAttributeVO',
                'DateTimeInterface',
            ))
            ->because('Interface should only depend on Entity, DTO, VO and DateTimeInterface');
    }

    public static function uniformNamingForController(): ArchRule
    {
        return self::uniformNaming('Controller');
    }

    public static function controllerMustUseSymfonRouteAttribute(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Controller'))
            ->should(new DependsOnTheseNamespaces('Symfony\\Component\\Routing\\Annotation\\Route'))
            ->because('Controller should have dependency on Route attribute from Symfony Routing');
    }

    public static function controllerDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Controller'))
            ->should(new DependsOnTheseNamespaces(
                'App\\Entity',
                'App\\Form',
                'App\\Repository',
                'App\\Service',
                'Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController',
                'Symfony\\Component\\HttpFoundation\\JsonResponse',
                'Symfony\\Component\\HttpFoundation\\RedirectResponse',
                'Symfony\\Component\\HttpFoundation\\Request',
                'Symfony\\Component\\HttpFoundation\\Response',
                'Symfony\\Component\\Security\\Http\\Attribute\\IsGranted',
            ))
            ->because('Controller should have dependency on AbstractController, Response, Request, RedirectResponse, JsonResponse, IsGranted attribute from Symfony Security, Entity, Form, Repository and Service');
    }

    public static function uniformNamingForDecorator(): ArchRule
    {
        return self::uniformNaming('Decorator');
    }

    public static function decoratorMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Decorator'))
            ->should(new IsFinal())
            ->because('Decorators are not meant to be extended but composed');
    }

    public static function uniformNamingForDoctrineExtension(): ArchRule
    {
        return self::uniformNaming('DoctrineExtension');
    }

    public static function doctrineExtensionShouldImplementQueryCollectionExtensionInterface(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\DoctrineExtension'))
            ->should(new Implement('ApiPlatform\\Doctrine\\Orm\\Extension\\QueryCollectionExtensionInterface',))
            ->because('DoctrineExtension should implement ApiPlatform Doctrine QueryCollectionExtensionInterface');
    }

    public static function doctrineExtensionShouldImplementQueryItemExtensionInterface(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\DoctrineExtension'))
            ->should(new Implement('ApiPlatform\\Doctrine\\Orm\\Extension\\QueryItemExtensionInterface',))
            ->because('DoctrineExtension should implement ApiPlatform Doctrine QueryItemExtensionInterface');
    }

    public static function doctrineExtensionMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\DoctrineExtension'))
            ->should(new IsFinal())
            ->because('DoctrineExtension are not meant to be extended');
    }

    public static function uniformNamingForEngine(): ArchRule
    {
        return self::uniformNaming('Engine');
    }

    public static function engineMustNotDependOnTime(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Engine'))
            ->should(new NotDependsOnTheseNamespaces(
                'Psr\\Clock\\ClockInterface',
                'Symfony\\Component\\Clock\\ClockInterface',
            ))
            ->because('time should be injected in Engine instead of using ClockInterface or Psr ClockInterface directly');
    }

    public static function uniformNamingForEngineRule(): ArchRule
    {
        return self::uniformNaming('EngineRule');
    }

    public static function engineRuleMustNotDependOnTime(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\EngineRule'))
            ->should(new NotDependsOnTheseNamespaces(
                'Psr\\Clock\\ClockInterface',
                'Symfony\\Component\\Clock\\ClockInterface',
            ))
            ->because('time should be injected in EngineRule instead of using ClockInterface or Psr ClockInterface directly');
    }

    public static function uniformNamingForEvent(): ArchRule
    {
        return self::uniformNaming('Event');
    }

    public static function eventDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Event'))
            ->should(new DependsOnTheseNamespaces(
                'App\\Entity',
                'Symfony\\Contracts\\EventDispatcher\\Event',
            ))
            ->because('Event should have dependency on Event from Symfony EventDispatcher and Entity');
    }

    public static function uniformNamingForFormType(): ArchRule
    {
        return self::uniformNaming('FormType');
    }

    public static function formMustExtendSymfonyAbstractType(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Form'))
            ->should(new Extend('Symfony\\Component\\Form\\AbstractType'))
            ->because('Form should extend Symfony Form AbstractType');
    }

    public static function formTypeMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Form'))
            ->should(new IsFinal())
            ->because('Form are not meant to be extended, except using Symfony best practices');
    }

    public static function uniformNamingForGenerator(): ArchRule
    {
        return self::uniformNaming('Generator');
    }

    public static function uniformNamingForHttp(): ArchRule
    {
        return self::uniformNaming('Http');
    }

    public static function httpMustBeLoggable(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Http'))
            ->should(new DependsOnTheseNamespaces('Psr\\Log\\LoggerInterface'))
            ->because('Http should have dependency on LoggerInterface');
    }

    public static function httpMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Http'))
            ->should(new IsFinal())
            ->because('Extending a Http is not a good practice and should be decorated using Symfony Decorator Pattern');
    }

    public static function uniformNamingForListener(): ArchRule
    {
        return self::uniformNaming('Listener');
    }

    public static function listenerDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Listener'))
            ->should(new DependsOnTheseNamespaces(
                'Doctrine\\Bundle\\DoctrineBundle\\Attribute\\AsEntityListener',
                'App\\Entity',
                'App\\Service',
                'Symfony\Component\Clock\ClockInterface',
            ))
            ->because('Listener should have dependency on AsEntityListener attribute from Doctrine');
    }

    public static function listenerShouldNotThrowDoctrineException(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Listener'))
            ->should(new NotDependsOnTheseNamespaces(
                'Doctrine\\ORM\\NonUniqueResultException',
                'Doctrine\\ORM\\NoResultException',
            ))
            ->because('Doctrine Exception should not be used in Listener, catch them in Service instead, log them and rethrow a specific Exception');
    }

    public static function listenerShouldBeLoggable(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Listener'))
            ->should(new DependsOnTheseNamespaces('Psr\\Log\\LoggerInterface'))
            ->because('Listener should have dependency on LoggerInterface');
    }

    public static function uniformNamingForLogger(): ArchRule
    {
        return self::uniformNaming('Logger');
    }

    public static function loggerShouldDependOnLoggerInterface(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Logger'))
            ->should(new DependsOnTheseNamespaces('Psr\\Log\\LoggerInterface'))
            ->because('Logger should have dependency on LoggerInterface');
    }

    public static function uniformNamingForMigration(): ArchRule
    {
        return self::uniformNaming('Migration');
    }

    public static function uniformNamingForNormalizer(): ArchRule
    {
        return self::uniformNaming('Normalizer');
    }

    public static function normalizerMustBeLoggable(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Normalizer'))
            ->should(new DependsOnTheseNamespaces('Psr\\Log\\LoggerInterface'))
            ->because('Normalizer should have dependency on LoggerInterface');
    }

    public static function uniformNamingForProfiler(): ArchRule
    {
        return self::uniformNaming('Profiler');
    }

    public static function uniformNamingForProfilerDataCollector(): ArchRule
    {
        return self::uniformNaming('ProfilerDataCollector');
    }

    public static function uniformNamingForRepository(): ArchRule
    {
        return self::uniformNaming('Repository');
    }

    public static function repositoryMustHaveAtournayreDoctrineTraits(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Repository'))
            ->should(new DependsOnTheseNamespaces(
                'Atournayre\\Component\\Doctrine\\Traits\\SaveTrait',
                'Atournayre\\Component\\Doctrine\\Traits\\RemoveTrait',
                'Atournayre\\Component\\Doctrine\\Traits\\SaveAndRemoveTrait',
            ))
            ->because('Repository should have dependency on SaveTrait, RemoveTrait or SaveAndRemoveTrait, to avoid code duplication and provide useful methods. If not installed, use composer require atournayre/doctrine-component.');
    }

    public static function uniformNamingForSearch(): ArchRule
    {
        return self::uniformNaming('Search');
    }

    public static function uniformNamingForSecurity(): ArchRule
    {
        return self::uniformNaming('Security');
    }

    public static function securityDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Security'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\\Entity',
                'App\\Service',
                'App\\Repository',
                'Symfony\\Component\\HttpFoundation',
                'Symfony\\Component\\Routing',
                'Symfony\\Component\\Security',
            ))
            ->because('Security should have dependency on Entity, Service, Repository and Symfony Security');
    }

    public static function uniformNamingForService(): ArchRule
    {
        return self::uniformNaming('Service');
    }

    public static function serviceMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Service'))
            ->should(new IsFinal())
            ->because('Service are not meant to be extended but decorated using Symfony Decorator Pattern');
    }

    public static function serviceMustBeLoggable(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Service'))
            ->should(new DependsOnTheseNamespaces('Psr\\Log\\LoggerInterface'))
            ->because('Service should have dependency on LoggerInterface');
    }

    public static function uniformNamingForServiceListener(): ArchRule
    {
        return self::uniformNaming('ServiceListener');
    }

    public static function uniformNamingForServiceSubscriber(): ArchRule
    {
        return self::uniformNaming('ServiceSubscriber');
    }

    public static function uniformNamingForServiceState(): ArchRule
    {
        return self::uniformNaming('ServiceState');
    }

    public static function uniformNamingForServiceStateProcessor(): ArchRule
    {
        return self::uniformNaming('ServiceStateProcessor');
    }

    public static function uniformNamingForServiceStateProvider(): ArchRule
    {
        return self::uniformNaming('ServiceStateProvider');
    }

    public static function uniformNamingForState(): ArchRule
    {
        return self::uniformNaming('State');
    }

    public static function uniformNamingForStateProvider(): ArchRule
    {
        return self::uniformNaming('StateProvider');
    }

    public static function stateProviderMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\State\\Provider'))
            ->should(new IsFinal())
            ->because('StateProvider are not meant to be extended but decorated using Symfony Decorator Pattern');
    }

    public static function uniformNamingForStateProcessor(): ArchRule
    {
        return self::uniformNaming('StateProcessor');
    }

    public static function stateProcessorMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\State\\Processor'))
            ->should(new IsFinal())
            ->because('StateProcessor are not meant to be extended but decorated using Symfony Decorator Pattern');
    }

    public static function uniformNamingForSubscriber(): ArchRule
    {
        return self::uniformNaming('Subscriber');
    }

    public static function uniformNamingForTrait(): ArchRule
    {
        return self::uniformNaming('Trait');
    }

    public static function entityDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Entity'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'ApiPlatform\\Metadata\\ApiResource',
                'ApiPlatform\\Metadata\\Delete',
                'ApiPlatform\\Metadata\\Get',
                'ApiPlatform\\Metadata\\GetCollection',
                'ApiPlatform\\Metadata\\Patch',
                'ApiPlatform\\Metadata\\Post',
                'ApiPlatform\\OpenApi\\Model',
                'App\\ApiPlatform\\Endpoint',
                'App\\ApiResource\\Groupes',
                'App\\Enum',
                'ArrayObject',
                'Doctrine\\ORM\\Mapping',
                'Symfony\\Component\\HttpFoundation\\File\\File',
                'Symfony\\Component\\Validator\\Constraints',
                'Vich\\UploaderBundle\\Mapping\\Annotation',
            ))
            ->because('Entity should have dependency on ApiPlatform, ArrayObject, Doctrine Mapping, Symfony File, Symfony Validator and Vich UploaderBundle');
    }

    public static function entitiesShouldImplementIsEntityInterface(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Entity'))
            ->should(new Implement('Atournayre\\Component\\Doctrine\\Contracts\\IsEntityInterface'))
            ->because('it simplifies the check of the type of an object, and will be useful in repositories. If not installed, use composer require atournayre/doctrine-component.');
    }

    public static function entitiesShouldNotThrowDoctrineException(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Entity'))
            ->should(new NotDependsOnTheseNamespaces(
                'Doctrine\\ORM\\NonUniqueResultException',
                'Doctrine\\ORM\\NoResultException',
            ))
            ->because('Doctrine Exception should not be used in Entity, catch them in Repository instead, log them and rethrow a specific Exception');
    }

    public static function entityExceptionNameMustNotEndWithException(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Entity\\Exception'))
            ->should(new NotHaveNameMatching('*Exception'))
            ->because('Exception should not be suffixed by Exception in order to be meaningful when suffixed by named constructor');
    }

    public static function entityExceptionDependencies(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Entity\\Exception'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\\Entity',
                'App\\Enum',
                'App\\VO',
                'DateTimeInterface',
                'RuntimeException',
            ))
            ->because('Exception should only depend on Entity, Enum, VO, DateTimeInterface and RuntimeException');
    }

    public static function enumShouldImplementEnumInterface(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Enum'))
            ->should(new Implement('App\\Contracts\\EnumInterface',))
            ->because('Enum should implement EnumInterface');
    }

    public static function voMustNotEndWithVo(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\VO'))
            ->should(new NotHaveNameMatching('*VO'))
            ->because('VO should not be suffixed by VO');
    }

    public static function voMustBeFinal(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\VO'))
            ->should(new IsFinal())
            ->because('Extending a VO is not a good practice');
    }

    public static function exceptionMustNotEndWithException(): ArchRule
    {
        return BaseRule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\Exception'))
            ->should(new NotHaveNameMatching('*Exception'))
            ->because('Exception should not be suffixed by Exception in order to be meaningful when suffixed by named constructor');
    }
}
