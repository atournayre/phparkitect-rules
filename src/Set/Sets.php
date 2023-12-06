<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Set;

use Arkitect\Rules\ArchRule;
use Atournayre\PHPArkitect\Rules\ApiResourceShouldBeFinalApi;
use Atournayre\PHPArkitect\Rules\ClassImplementingProcessorInterfaceShouldResideInAppStateApiPlatform;
use Atournayre\PHPArkitect\Rules\ClassImplementingProviderInterfaceShouldResideInAppStateApiPlatform;
use Atournayre\PHPArkitect\Rules\CollectionDependenciesMisc;
use Atournayre\PHPArkitect\Rules\CommandMustExtendSymfonyCommand;
use Atournayre\PHPArkitect\Rules\CommandMustUseSymfonyAsCommandAttribute;
use Atournayre\PHPArkitect\Rules\ContractsDependenciesMisc;
use Atournayre\PHPArkitect\Rules\ControllerDependenciesSymfony;
use Atournayre\PHPArkitect\Rules\ControllerMustUseSymfonyRouteAttribute;
use Atournayre\PHPArkitect\Rules\DecoratorMustBeFinalMisc;
use Atournayre\PHPArkitect\Rules\DoctrineExtensionMustBeFinalApiPlatform;
use Atournayre\PHPArkitect\Rules\DoctrineExtensionShouldImplementQueryCollectionExtensionInterfaceApiPlatform;
use Atournayre\PHPArkitect\Rules\DoctrineExtensionShouldImplementQueryItemExtensionInterfaceApiPlatform;
use Atournayre\PHPArkitect\Rules\DtoMustBeFinalMisc;
use Atournayre\PHPArkitect\Rules\DtoMustNotEndWithDtoMisc;
use Atournayre\PHPArkitect\Rules\EngineMustNotDependOnTimeMisc;
use Atournayre\PHPArkitect\Rules\EngineRuleMustNotDependOnTimeMisc;
use Atournayre\PHPArkitect\Rules\EntitiesShouldNotThrowDoctrineExceptionDomain;
use Atournayre\PHPArkitect\Rules\EntityDependenciesDomain;
use Atournayre\PHPArkitect\Rules\EntityExceptionDependenciesMisc;
use Atournayre\PHPArkitect\Rules\EntityExceptionNameMustNotEndWithExceptionDomain;
use Atournayre\PHPArkitect\Rules\EnumMisc;
use Atournayre\PHPArkitect\Rules\EnumShouldImplementEnumInterfaceMisc;
use Atournayre\PHPArkitect\Rules\EventCollectionDependenciesMisc;
use Atournayre\PHPArkitect\Rules\EventDependenciesSymfony;
use Atournayre\PHPArkitect\Rules\ExceptionMustNotEndWithExceptionMisc;
use Atournayre\PHPArkitect\Rules\FormMustExtendSymfonyAbstractType;
use Atournayre\PHPArkitect\Rules\FormTypeMustBeFinalSymfony;
use Atournayre\PHPArkitect\Rules\FormTypesShouldResideInAppFormTypeSymfony;
use Atournayre\PHPArkitect\Rules\HttpMustBeFinalMisc;
use Atournayre\PHPArkitect\Rules\ListenerDependenciesDoctrine;
use Atournayre\PHPArkitect\Rules\ListenerShouldNotThrowDoctrineExceptionDoctrine;
use Atournayre\PHPArkitect\Rules\ProvidersAndProcessorsShouldBeFinalApiPlatform;
use Atournayre\PHPArkitect\Rules\SecurityDependenciesSymfony;
use Atournayre\PHPArkitect\Rules\ServiceMustBeFinalSymfony;
use Atournayre\PHPArkitect\Rules\UniformNamingForApiResourceApi;
use Atournayre\PHPArkitect\Rules\UniformNamingForCollectionMisc;
use Atournayre\PHPArkitect\Rules\UniformNamingForContractsMisc;
use Atournayre\PHPArkitect\Rules\UniformNamingForDecoratorMisc;
use Atournayre\PHPArkitect\Rules\UniformNamingForDoctrineExtensionApiPlatform;
use Atournayre\PHPArkitect\Rules\UniformNamingForEngineMisc;
use Atournayre\PHPArkitect\Rules\UniformNamingForEngineRuleMisc;
use Atournayre\PHPArkitect\Rules\UniformNamingForHttpMisc;
use Atournayre\PHPArkitect\Rules\UniformNamingForLoggerLog;
use Atournayre\PHPArkitect\Rules\UniformNamingForMigrationDoctrine;
use Atournayre\PHPArkitect\Rules\UniformNamingForStateProcessorApiPlatform;
use Atournayre\PHPArkitect\Rules\UniformNamingForStateProviderApiPlatform;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyCommand;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyController;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyEvent;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyFormType;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyListener;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyNormalizer;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyProfiler;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyProfilerDataCollector;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyRepository;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonySecurity;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonyService;
use Atournayre\PHPArkitect\Rules\UniformNamingForSymfonySubscriber;
use Atournayre\PHPArkitect\Rules\VoMustBeFinalMisc;
use Atournayre\PHPArkitect\Rules\VoMustNotEndWithVoMisc;
use Webmozart\Assert\Assert;

class Sets
{
    public static function apiPlatformUniformNaming(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForDoctrineExtensionApiPlatform,
            new UniformNamingForStateProcessorApiPlatform,
            new UniformNamingForStateProviderApiPlatform,
        ]);
    }

    public static function apiPlatformDoctrineExtension(): array
    {
        return self::buildArrayOfRules([
            new DoctrineExtensionShouldImplementQueryItemExtensionInterfaceApiPlatform,
            new DoctrineExtensionShouldImplementQueryCollectionExtensionInterfaceApiPlatform,
            new DoctrineExtensionMustBeFinalApiPlatform,
        ]);
    }

    public static function apiPlatformState(): array
    {
        return self::buildArrayOfRules([
            new ClassImplementingProviderInterfaceShouldResideInAppStateApiPlatform,
            new ClassImplementingProcessorInterfaceShouldResideInAppStateApiPlatform,
            new ProvidersAndProcessorsShouldBeFinalApiPlatform,
        ]);
    }

    public static function apiUniformNaming(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForApiResourceApi,
        ]);
    }

    public static function apiResource(): array
    {
        return self::buildArrayOfRules([
            new ApiResourceShouldBeFinalApi,
        ]);
    }

    public static function doctrineUniformNaming(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForMigrationDoctrine,
        ]);
    }

    public static function doctrineListener(): array
    {
        return self::buildArrayOfRules([
            new ListenerDependenciesDoctrine,
            new ListenerShouldNotThrowDoctrineExceptionDoctrine,
        ]);
    }

    public static function domainEntities(): array
    {
        return self::buildArrayOfRules([
            new EntityDependenciesDomain,
            new EntityExceptionNameMustNotEndWithExceptionDomain,
            new EntitiesShouldNotThrowDoctrineExceptionDomain,
        ]);
    }

    public static function logUniformNaming(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForLoggerLog,
        ]);
    }

    public static function symfonyUniformNaming(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonyCommand,
            new UniformNamingForSymfonyController,
            new UniformNamingForSymfonyProfilerDataCollector,
            new UniformNamingForSymfonyProfiler,
            new UniformNamingForSymfonyFormType,
            new UniformNamingForSymfonyRepository,
            new UniformNamingForSymfonyNormalizer,
            new UniformNamingForSymfonyService,
            new UniformNamingForSymfonyListener,
            new UniformNamingForSymfonyEvent,
            new UniformNamingForSymfonySecurity,
            new UniformNamingForSymfonySubscriber,
        ]);
    }

    public static function symfonyCommand(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonyCommand,
            new CommandMustExtendSymfonyCommand,
            new CommandMustUseSymfonyAsCommandAttribute,
        ]);
    }

    public static function symfonyController(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonyController,
            new ControllerMustUseSymfonyRouteAttribute,
            new ControllerDependenciesSymfony,
        ]);
    }

    public static function symfonyEvent(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonyEvent,
            new EventDependenciesSymfony,
        ]);
    }

    public static function symfonyForm(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonyFormType,
            new FormMustExtendSymfonyAbstractType,
            new FormTypesShouldResideInAppFormTypeSymfony,
            new FormTypeMustBeFinalSymfony,
        ]);
    }

    public static function symfonySecurity(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonySecurity,
            new SecurityDependenciesSymfony,
        ]);
    }

    public static function symfonyService(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForSymfonyService,
            new ServiceMustBeFinalSymfony,
        ]);
    }

    /**
     * @param array $rules
     * @return array
     */
    public static function buildArrayOfRules(array $rules): array
    {
        $arrayOfRules = array_map(
            fn($rule) => self::buildArrayOfRules($rule),
            $rules
        );

        Assert::allIsInstanceOf($arrayOfRules, ArchRule::class, 'The object passed in parameter is not an ArchRule.');
        return $arrayOfRules;
    }

    public static function collection(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForCollectionMisc,
            new CollectionDependenciesMisc,
            new EventCollectionDependenciesMisc,
        ]);
    }

    public static function dto(): array
    {
        return self::buildArrayOfRules([
            new DtoMustNotEndWithDtoMisc,
            new DtoMustBeFinalMisc,
        ]);
    }

    public static function vo(): array
    {
        return self::buildArrayOfRules([
            new VoMustNotEndWithVoMisc,
            new VoMustBeFinalMisc,
        ]);
    }

    public static function decorator(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForDecoratorMisc,
            new DecoratorMustBeFinalMisc,
        ]);
    }

    public static function contracts(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForContractsMisc,
            new ContractsDependenciesMisc,
        ]);
    }

    public static function engine(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForEngineMisc,
            new EngineMustNotDependOnTimeMisc,
            new UniformNamingForEngineRuleMisc,
            new EngineRuleMustNotDependOnTimeMisc,
        ]);
    }

    public static function http(): array
    {
        return self::buildArrayOfRules([
            new UniformNamingForHttpMisc,
            new HttpMustBeFinalMisc,
        ]);
    }

    public static function enum(): array
    {
        return self::buildArrayOfRules([
            new EnumMisc,
            new EnumShouldImplementEnumInterfaceMisc,
        ]);
    }

    public static function exception(): array
    {
        return self::buildArrayOfRules([
            new EntityExceptionDependenciesMisc,
            new ExceptionMustNotEndWithExceptionMisc,
        ]);
    }
}
