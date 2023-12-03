<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;

final class DoctrineRule extends Rule
{
    public static function uniformNamingForMigration(): ArchRule
    {
        return self::uniformNaming('Migration');
    }

    public static function listenerDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Listener'))
            ->should(new DependsOnlyOnTheseNamespaces(
                'Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener',
                'Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener',
                'Doctrine\ORM\Event',
                'Doctrine\ORM\Events',
                'App\Decorator',
                'App\DTO',
                'App\Entity',
                'App\Enum',
                'App\Service',
                'App\Repository',
                'App\VO',
                'Symfony\Component\Clock\ClockInterface',
                'Webmozart\Assert\Assert',
            ))
            ->because('Listener should have dependency on AsEntityListener attribute from Doctrine');
    }

    public static function listenerShouldNotThrowDoctrineException(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Listener'))
            ->should(new NotDependsOnTheseNamespaces(
                'Doctrine\ORM\NonUniqueResultException',
                'Doctrine\ORM\NoResultException',
            ))
            ->because('Doctrine Exception should not be used in Listener, catch them in Service instead, log them and rethrow a specific Exception');
    }
}
