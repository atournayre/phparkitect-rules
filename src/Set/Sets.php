<?php

namespace Atournayre\PHPArkitect\Set;

use Arkitect\Rules\ArchRule;
use Atournayre\PHPArkitect\Rule\ApiPlaformRule;
use Atournayre\PHPArkitect\Rule\ApiRule;
use Atournayre\PHPArkitect\Rule\DoctrineRule;
use Atournayre\PHPArkitect\Rule\DomainRule;
use Atournayre\PHPArkitect\Rule\LogRule;
use Atournayre\PHPArkitect\Rule\MiscRule;
use Atournayre\PHPArkitect\Rule\SymfonyRule;
use Webmozart\Assert\Assert;

class Sets
{
    public static function apiPlatform(): array
    {
        return self::buildArrayOfRules([
            ApiPlaformRule::all(),
        ]);
    }

    public static function apiPlatformUniformNaming(): array
    {
        return self::buildArrayOfRules([
            ApiPlaformRule::uniformNamingForDoctrineExtension(),
            ApiPlaformRule::uniformNamingForStateProcessor(),
            ApiPlaformRule::uniformNamingForStateProvider(),
        ]);
    }

    public static function apiPlatformDoctrineExtension(): array
    {
        return self::buildArrayOfRules([
            ApiPlaformRule::doctrineExtensionShouldImplementQueryItemExtensionInterface(),
            ApiPlaformRule::doctrineExtensionShouldImplementQueryCollectionExtensionInterface(),
            ApiPlaformRule::doctrineExtensionMustBeFinal(),
        ]);
    }

    public static function apiPlatformState(): array
    {
        return self::buildArrayOfRules([
            ApiPlaformRule::classImplementingProviderInterfaceShouldResideInAppState(),
            ApiPlaformRule::classImplementingProcessorInterfaceShouldResideInAppState(),
            ApiPlaformRule::providersAndProcessorsShouldBeFinal(),
        ]);
    }

    public static function api(): array
    {
        return self::buildArrayOfRules([
            ApiRule::all(),
        ]);
    }

    public static function apiUniformNaming(): array
    {
        return self::buildArrayOfRules([
            ApiRule::uniformNamingForApiResource(),
        ]);
    }

    public static function apiResource(): array
    {
        return self::buildArrayOfRules([
            ApiRule::apiResourceShouldBeFinal(),
        ]);
    }

    public static function doctrine(): array
    {
        return self::buildArrayOfRules([
            DoctrineRule::all(),
        ]);
    }

    public static function doctrineUniformNaming(): array
    {
        return self::buildArrayOfRules([
            DoctrineRule::uniformNamingForMigration(),
        ]);
    }

    public static function doctrineListener(): array
    {
        return self::buildArrayOfRules([
            DoctrineRule::listenerDependencies(),
            DoctrineRule::listenerShouldNotThrowDoctrineException(),
        ]);
    }

    public static function domain(): array
    {
        return self::buildArrayOfRules([
            DomainRule::all(),
        ]);
    }

    public static function domainEntities(): array
    {
        return self::buildArrayOfRules([
            DomainRule::entityDependencies(),
            DomainRule::entityExceptionNameMustNotEndWithException(),
            DomainRule::entitiesShouldNotThrowDoctrineException(),
        ]);
    }

    public static function log(): array
    {
        return self::buildArrayOfRules([
            LogRule::all(),
        ]);
    }

    public static function logUniformNaming(): array
    {
        return self::buildArrayOfRules([
            LogRule::uniformNamingForLogger(),
        ]);
    }

    public static function symfony(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::all(),
        ]);
    }

    public static function symfonyUniformNaming(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForCommand(),
            SymfonyRule::uniformNamingForController(),
            SymfonyRule::uniformNamingForProfilerDataCollector(),
            SymfonyRule::uniformNamingForProfiler(),
            SymfonyRule::uniformNamingForFormType(),
            SymfonyRule::uniformNamingForRepository(),
            SymfonyRule::uniformNamingForNormalizer(),
            SymfonyRule::uniformNamingForService(),
            SymfonyRule::uniformNamingForListener(),
            SymfonyRule::uniformNamingForEvent(),
            SymfonyRule::uniformNamingForSecurity(),
            SymfonyRule::uniformNamingForSubscriber(),
        ]);
    }

    public static function symfonyCommand(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForCommand(),
            SymfonyRule::commandMustExtendSymfonyCommand(),
            SymfonyRule::commandMustUseSymfonyAsCommandAttribute(),
        ]);
    }

    public static function symfonyController(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForController(),
            SymfonyRule::controllerMustUseSymfonyRouteAttribute(),
            SymfonyRule::controllerDependencies(),
        ]);
    }

    public static function symfonyEvent(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForEvent(),
            SymfonyRule::eventDependencies(),
        ]);
    }

    public static function symfonyForm(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForFormType(),
            SymfonyRule::formMustExtendSymfonyAbstractType(),
            SymfonyRule::formTypesShouldResideInAppFormType(),
            SymfonyRule::formTypeMustBeFinal(),
        ]);
    }

    public static function symfonySecurity(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForSecurity(),
            SymfonyRule::securityDependencies(),
        ]);
    }

    public static function symfonyService(): array
    {
        return self::buildArrayOfRules([
            SymfonyRule::uniformNamingForService(),
            SymfonyRule::serviceMustBeFinal(),
        ]);
    }

    /**
     * @param array $rules
     * @return array
     */
    public static function buildArrayOfRules(array $rules): array
    {
        $arrayOfRules = [];
        foreach ($rules as $rule) {
            if (is_array($rule)) {
                $arrayOfRules = array_merge($arrayOfRules, $rule);
            } else {
                $arrayOfRules[] = $rule;
            }
        }

        Assert::allIsInstanceOf($arrayOfRules, ArchRule::class, 'The object passed in parameter is not an ArchRule.');
        return $arrayOfRules;
    }

    public static function collection(): array
    {
        return self::buildArrayOfRules([
            MiscRule::uniformNamingForCollection(),
            MiscRule::collectionDependencies(),
            MiscRule::eventCollectionDependencies(),
        ]);
    }

    public static function dto(): array
    {
        return self::buildArrayOfRules([
            MiscRule::dtoMustNotEndWithDto(),
            MiscRule::dtoMustBeFinal(),
        ]);
    }

    public static function vo(): array
    {
        return self::buildArrayOfRules([
            MiscRule::voMustNotEndWithVo(),
            MiscRule::voMustBeFinal(),
        ]);
    }

    public static function decorator(): array
    {
        return self::buildArrayOfRules([
            MiscRule::uniformNamingForDecorator(),
            MiscRule::decoratorMustBeFinal(),
        ]);
    }

    public static function contracts(): array
    {
        return self::buildArrayOfRules([
            MiscRule::uniformNamingForContracts(),
            MiscRule::contractsDependencies(),
        ]);
    }

    public static function engine(): array
    {
        return self::buildArrayOfRules([
            MiscRule::uniformNamingForEngine(),
            MiscRule::engineMustNotDependOnTime(),
            MiscRule::uniformNamingForEngineRule(),
            MiscRule::engineRuleMustNotDependOnTime(),
        ]);
    }

    public static function http(): array
    {
        return self::buildArrayOfRules([
            MiscRule::uniformNamingForHttp(),
            MiscRule::httpMustBeFinal(),
        ]);
    }

    public static function enum(): array
    {
        return self::buildArrayOfRules([
            MiscRule::enum(),
            MiscRule::enumShouldImplementEnumInterface(),
        ]);
    }

    public static function exception(): array
    {
        return self::buildArrayOfRules([
            MiscRule::entityExceptionDependencies(),
            MiscRule::exceptionMustNotEndWithException(),
        ]);
    }
}
