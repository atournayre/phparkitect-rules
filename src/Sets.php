<?php

namespace Atournayre\PHPArkitect;

use Webmozart\Assert\Assert;

class Sets
{
    public static function symfonyApiPlatform(): array
    {
        return array_merge(
            self::apiResource(),
            self::apiDocumentation(),
            self::collection(),
            self::command(),
            self::contracts(),
            self::controller(),
            self::decorator(),
            self::doctrineExtension(),
            self::dto(),
            self::engine(),
            self::entity(),
            self::enum(),
            self::event(),
            self::form(),
            self::http(),
            self::logger(),
            self::repository(),
            self::security(),
            self::service(),
            self::stateProvider(),
            self::stateProcessor(),
            self::vo(),
            self::normalizer(),
            self::migration(),
            self::listener(),
            self::engineRule(),
            self::generator(),
            self::profiler(),
            self::search(),
            self::serviceListener(),
            self::serviceSubscriber(),
            self::serviceState(),
            self::serviceStateProcessor(),
            self::serviceStateProvider(),
            self::state(),
            self::subscriber(),
            self::trait(),
        );
    }

    public static function apiResource(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForApiResource(),
            Rule::apiResourceShouldBeFinal(),
        ]);
    }

    public static function buildArrayOfRules(array $rules): array
    {
        Assert::allIsInstanceOf($rules, \Arkitect\Rules\Rule::class, 'The object passed in parameter is not an ArchRule.');
        return $rules;
    }

    public static function apiDocumentation(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForApiDocumentation(),
            Rule::apiDocumentationOpenApi(),
        ]);
    }

    public static function collection(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForCollection(),
            Rule::collectionDependencies(),
        ]);
    }

    public static function command(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForCommand(),
            Rule::commandMustUseSymfonyAsCommandAttribute(),
            Rule::commandMustExtendSymfonyCommand(),
            Rule::commandMustUseSymfonyStopwatch(),
        ]);
    }

    public static function contracts(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForContracts(),
            Rule::contractsDependencies(),
        ]);
    }

    public static function controller(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForController(),
            Rule::controllerMustUseSymfonRouteAttribute(),
            Rule::controllerDependencies(),
        ]);
    }

    public static function decorator(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForDecorator(),
            Rule::decoratorMustBeFinal(),
        ]);
    }

    public static function doctrineExtension(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForDoctrineExtension(),
            Rule::doctrineExtensionShouldImplementQueryCollectionExtensionInterface(),
            Rule::doctrineExtensionShouldImplementQueryItemExtensionInterface(),
            Rule::doctrineExtensionMustBeFinal(),
        ]);
    }

    public static function dto(): array
    {
        return self::buildArrayOfRules([
            Rule::dtoMustNotEndWithDto(),
            Rule::dtoMustBeFinal(),
        ]);
    }

    public static function engine(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForEngine(),
            Rule::engineMustNotDependOnTime(),
        ]);
    }

    public static function entity(): array
    {
        return self::buildArrayOfRules([
            Rule::entityDependencies(),
            Rule::entitiesShouldImplementIsEntityInterface(),
            Rule::entitiesShouldNotThrowDoctrineException(),
            Rule::entityExceptionNameMustNotEndWithException(),
            Rule::entityExceptionDependencies(),
        ]);
    }

    public static function enum(): array
    {
        return self::buildArrayOfRules([
            Rule::enumShouldImplementEnumInterface(),
        ]);
    }

    public static function event(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForEvent(),
            Rule::eventDependencies(),
        ]);
    }

    public static function form(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForFormType(),
            Rule::formMustExtendSymfonyAbstractType(),
            Rule::formTypeMustBeFinal(),
        ]);
    }

    public static function http(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForHttp(),
            Rule::httpMustBeLoggable(),
            Rule::httpMustBeFinal(),
        ]);
    }

    public static function logger(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForLogger(),
            Rule::loggerShouldDependOnLoggerInterface(),
        ]);
    }

    public static function repository(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForRepository(),
            Rule::repositoryMustHaveAtournayreDoctrineTraits(),
        ]);
    }

    public static function security(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForSecurity(),
            Rule::securityDependencies(),
        ]);
    }

    public static function service(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForService(),
            Rule::serviceMustBeFinal(),
            Rule::serviceMustBeLoggable(),
        ]);
    }

    public static function stateProvider(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForStateProvider(),
            Rule::stateProviderMustBeFinal(),
        ]);
    }

    public static function stateProcessor(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForStateProcessor(),
            Rule::stateProcessorMustBeFinal(),
        ]);
    }

    public static function vo(): array
    {
        return self::buildArrayOfRules([
            Rule::voMustNotEndWithVo(),
            Rule::voMustBeFinal(),
        ]);
    }

    public static function normalizer(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForNormalizer(),
            Rule::normalizerMustBeLoggable(),
        ]);
    }

    public static function migration(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForMigration(),
        ]);
    }

    public static function listener(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForListener(),
            Rule::listenerDependencies(),
            Rule::listenerShouldNotThrowDoctrineException(),
            Rule::listenerShouldBeLoggable(),
        ]);
    }

    public static function engineRule(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForEngineRule(),
            Rule::engineRuleMustNotDependOnTime(),
        ]);
    }

    public static function generator(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForGenerator(),
        ]);
    }

    public static function profiler(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForProfiler(),
            Rule::uniformNamingForProfilerDataCollector(),
        ]);
    }

    public static function search(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForSearch(),
        ]);
    }

    public static function serviceListener(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForServiceListener(),
        ]);
    }

    public static function serviceSubscriber(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForServiceSubscriber(),
        ]);
    }

    public static function serviceState(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForServiceState(),
        ]);
    }

    public static function serviceStateProcessor(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForServiceStateProcessor(),
        ]);
    }

    public static function serviceStateProvider(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForServiceStateProvider(),
        ]);
    }

    public static function state(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForState(),
        ]);
    }

    public static function subscriber(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForSubscriber(),
        ]);
    }

    public static function trait(): array
    {
        return self::buildArrayOfRules([
            Rule::uniformNamingForTrait(),
        ]);
    }
}
