<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\IsEnum;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\IsTrait;
use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespaces;
use Webmozart\Assert\Assert;

final class MiscRule extends Rule
{
    public static function collectionDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Collection'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'Carbon\Carbon',
                'DateTimeInterface',
                'Doctrine\Common\Collections\Collection',
                'Doctrine\Common\Collections\Criteria',
                'Doctrine\Common\Collections\ArrayCollection',
                'Doctrine\Common\Collections\ReadableCollection',
                'Doctrine\ORM\PersistentCollection',
                Assert::class,
            ))
            ->because('Collection should only depend on Entity, Carbon, DateTimeInterface, Doctrine Collection, Doctrine Criteria, Doctrine ReadableCollection, Doctrine PersistentCollection and Webmozart Assert');
    }

    public static function eventCollectionDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Event\Collection'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'Carbon\Carbon',
                'DateTimeInterface',
                'Doctrine\Common\Collections\Collection',
                'Doctrine\Common\Collections\Criteria',
                'Doctrine\Common\Collections\ArrayCollection',
                'Doctrine\Common\Collections\ReadableCollection',
                'Doctrine\ORM\PersistentCollection',
                Assert::class,
                'Symfony\Contracts\EventDispatcher\Event'
            ))
            ->because('Collection should only depend on Entity, Carbon, DateTimeInterface, Doctrine Collection, Doctrine Criteria, Doctrine ReadableCollection, Doctrine PersistentCollection, Webmozart Assert and Symfony EventDispatcher Event');
    }

    public static function uniformNamingForCollection(): ArchRule
    {
        return self::uniformNaming('Collection');
    }

    public static function dtoMustNotEndWithDto(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\DTO'))
            ->should(new NotHaveNameMatching('*DTO'))
            ->because('DTO should not be suffixed by DTO');
    }

    public static function dtoMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\DTO'))
            ->should(new IsFinal())
            ->because('Extending a DTO is not a good practice');
    }

    public static function voMustNotEndWithVo(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\VO'))
            ->should(new NotHaveNameMatching('*VO'))
            ->because('VO should not be suffixed by VO');
    }

    public static function voMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\VO'))
            ->should(new IsFinal())
            ->because('Extending a VO is not a good practice');
    }

    public static function uniformNamingForDecorator(): ArchRule
    {
        return self::uniformNaming('Decorator');
    }

    public static function decoratorMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Decorator'))
            ->should(new IsFinal())
            ->because('Decorators are not meant to be extended but composed');
    }

    public static function uniformNamingForApiDocumentation(): ArchRule
    {
        return self::uniformNaming('ApiDocumentation');
    }

    public static function apiDocumentationOpenApi(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Api\Documentation'))
            ->should(new HaveNameMatching('/OpenApi$/'))
            ->because('API Documentation should have a name with "OpenApi" inside');
    }

    public static function commandMustUseSymfonyStopwatch(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Command'))
            ->should(new DependsOnTheseNamespaces('Symfony\Component\Stopwatch\Stopwatch'))
            ->because('We use Stopwatch to measure time of command execution');
    }

    public static function uniformNamingForContracts(): ArchRule
    {
        return self::uniformNaming('Interface');
    }

    public static function contractsDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Contracts'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'App\DTO',
                'App\VO',
                'DateTimeInterface',
            ))
            ->because('Interface should only depend on Entity, DTO, VO and DateTimeInterface');
    }

    public static function engineMustNotDependOnTime(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Engine'))
            ->should(new NotDependsOnTheseNamespaces(
                'Psr\Clock\ClockInterface',
                'Symfony\Component\Clock\ClockInterface',
            ))
            ->because('time should be injected in Engine instead of using ClockInterface or Psr ClockInterface directly');
    }

    public static function engineRuleMustNotDependOnTime(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\EngineRule'))
            ->should(new NotDependsOnTheseNamespaces(
                'Psr\Clock\ClockInterface',
                'Symfony\Component\Clock\ClockInterface',
            ))
            ->because('time should be injected in EngineRule instead of using ClockInterface or Psr ClockInterface directly');
    }

    public static function uniformNamingForEngine(): ArchRule
    {
        return self::uniformNaming('Engine');
    }

    public static function uniformNamingForTrait(): ArchRule
    {
        return self::uniformNaming('Trait');
    }

    public static function uniformNamingForGenerator(): ArchRule
    {
        return self::uniformNaming('Generator');
    }

    public static function uniformNamingForHttp(): ArchRule
    {
        return self::uniformNaming('Http');
    }

    public static function httpMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Http'))
            ->should(new IsFinal())
            ->because('Extending a Http is not a good practice and should be decorated using Symfony Decorator Pattern');
    }

    public static function uniformNamingForSearch(): ArchRule
    {
        return self::uniformNaming('Search');
    }

    public static function uniformNamingForEngineRule(): ArchRule
    {
        return self::uniformNaming('EngineRule');
    }

    public static function enum(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Enum'))
            ->should(new IsEnum())
            ->because('we want to be sure that all classes are enum');
    }

    public static function enumShouldImplementEnumInterface(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Enum'))
            ->should(new Implement('App\Contracts\EnumInterface',))
            ->because('Enum should implement EnumInterface');
    }

    public static function entityExceptionDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Entity\Exception'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'App\Enum',
                'App\VO',
                'DateTimeInterface',
                'RuntimeException',
            ))
            ->because('Exception should only depend on Entity, Enum, VO, DateTimeInterface and RuntimeException');
    }

    public static function exceptionMustNotEndWithException(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Exception'))
            ->should(new NotHaveNameMatching('*Exception'))
            ->because('Exception should not be suffixed by Exception in order to be meaningful when suffixed by named constructor');
    }

    public static function entitiesShouldImplementIsEntityInterface(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Entity'))
            ->should(new Implement('Atournayre\Component\Doctrine\Contracts\IsEntityInterface'))
            ->because('it simplifies the check of the type of an object, and will be useful in repositories. If not installed, use composer require atournayre/doctrine-component.');
    }

    public static function repositoryMustHaveAtournayreDoctrineTraits(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Repository'))
            ->should(new DependsOnTheseNamespaces(
                'Atournayre\Component\Doctrine\Traits',
            ))
            ->because('Repository should have dependency on Atournayre\Component\Doctrine\Traits, to avoid code duplication and provide useful methods. If not installed, use composer require atournayre/doctrine-component.');
    }

    public static function traits(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Traits'))
            ->should(new IsTrait())
            ->because('we want to be sure that there are only traits in a specific namespace');
    }
}
