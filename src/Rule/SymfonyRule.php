<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\Extend;
use Arkitect\Expression\ForClasses\HaveAttribute;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespaces;

final class SymfonyRule extends Rule
{
    public static function uniformNamingForCommand(): ArchRule
    {
        return self::uniformNaming('Command');
    }

    public static function commandMustExtendSymfonyCommand(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Command'))
            ->should(new Extend('Symfony\Component\Console\Command\Command'))
            ->because('Command should have dependency on Symfony Console Command');
    }

    public static function commandMustUseSymfonyAsCommandAttribute(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Command'))
            ->should(new HaveAttribute('AsCommand'))
            ->because('Command should have dependency on AsCommand attribute from Symfony Console');
    }

    public static function uniformNamingForController(): ArchRule
    {
        return self::uniformNaming('Controller');
    }

    public static function controllerMustUseSymfonRouteAttribute(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Controller'))
            ->should(new HaveAttribute('Route'))
            ->because('Controller should have dependency on Route attribute from Symfony Routing');
    }

    public static function controllerDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Controller'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'App\Form',
                'App\Service',
                'Symfony\Bundle\FrameworkBundle\Controller\AbstractController',
                'Symfony\Component\HttpFoundation\JsonResponse',
                'Symfony\Component\HttpFoundation\RedirectResponse',
                'Symfony\Component\HttpFoundation\Request',
                'Symfony\Component\HttpFoundation\Response',
                'Symfony\Component\Security\Http\Attribute\IsGranted',
            ))
            ->because('Controller should have dependency on AbstractController, Response, Request, RedirectResponse, JsonResponse, IsGranted attribute from Symfony Security, Entity, Form and Service');
    }

    public static function eventDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Event'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'Symfony\Contracts\EventDispatcher\Event',
            ))
            ->because('Event should depends only on Entity and Symfony Event');
    }

    public static function formMustExtendSymfonyAbstractType(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Form\Type'))
            ->should(new Extend('Symfony\Component\Form\AbstractType'))
            ->because('Form should extend Symfony Form AbstractType');
    }

    public static function formTypesShoudResideInAppFormType(): ArchRule
    {
        return self::allClasses()
            ->that(new Extend('Symfony\Component\Form\AbstractType'))
            ->should(new ResideInOneOfTheseNamespaces('App\Form\Type'))
            ->because('Form that extend Symfony Form AbstractType should reside in App\Form\Type');
    }

    public static function formTypeMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Form\Type'))
            ->should(new IsFinal())
            ->because('Form are not meant to be extended, except using Symfony best practices');
    }

    public static function uniformNamingForProfilerDataCollector(): ArchRule
    {
        return self::uniformNaming('ProfilerDataCollector');
    }

    public static function uniformNamingForProfiler(): ArchRule
    {
        return self::uniformNaming('Profiler');
    }

    public static function uniformNamingForFormType(): ArchRule
    {
        return self::uniformNaming('Type');
    }

    public static function uniformNamingForRepository(): ArchRule
    {
        return self::uniformNaming('Repository');
    }

    public static function uniformNamingForNormalizer(): ArchRule
    {
        return self::uniformNaming('Normalizer');
    }

    public static function securityDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Security'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'App\Entity',
                'App\Service',
                'App\Repository',
                'Symfony\Component\HttpFoundation',
                'Symfony\Component\Routing',
                'Symfony\Component\Security',
            ))
            ->because('Security should have dependency on Entity, Service, Repository and Symfony Security');
    }

    public static function uniformNamingForService(): ArchRule
    {
        return self::uniformNaming('Service');
    }

    public static function uniformNamingForListener(): ArchRule
    {
        return self::uniformNaming('Listener');
    }

    public static function uniformNamingForEvent(): ArchRule
    {
        return self::uniformNaming('Event');
    }

    public static function uniformNamingForSecurity(): ArchRule
    {
        return self::uniformNaming('Security');
    }

    public static function serviceMustBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Service'))
            ->should(new IsFinal())
            ->because('Service are not meant to be extended but decorated using Symfony Decorator Pattern');
    }

    public static function uniformNamingForSubscriber(): ArchRule
    {
        return self::uniformNaming('Subscriber');
    }
}
