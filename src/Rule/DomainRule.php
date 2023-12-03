<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\NotHaveDependencyOutsideNamespace;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;

final class DomainRule extends Rule
{
    public static function entityDependencies(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Entity'))
            ->should(new NotHaveDependencyOutsideNamespace('App\Entity', [
                'ApiPlatform\Doctrine',
                'ApiPlatform\Metadata',
                'ApiPlatform\OpenApi\Model',
                'App\ApiPlatform\Endpoint',
                'App\ApiResource\Groupes',
                'App\Collection',
                'App\Contracts',
                'App\DTO',
                'App\Enum',
                'App\Repository',
                'App\State',
                'App\State\Provider',
                'App\State\Processor',
                'App\VO',
                'ArrayObject',
                'Carbon',
                'DateTimeImmutable',
                'DateTimeInterface',
                'Doctrine\Common\Collections\Collection',
                'Doctrine\Common\Collections\Criteria',
                'Doctrine\Common\Collections\ArrayCollection',
                'Doctrine\DBAL\Types\Types',
                'Doctrine\ORM\Mapping',
                'Doctrine\ORM\PersistentCollection',
                'InvalidArgumentException',
                'RuntimeException',
                'Symfony\Bridge\Doctrine\Validator\Constraints',
                'Symfony\Component\HttpFoundation\File\File',
                'Symfony\Component\Validator\Constraints',
                'Symfony\Component\Uid\Uuid',
                'SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface',
                'Vich\UploaderBundle\Mapping\Annotation',
                'Webmozart\Assert\Assert',
            ]))
            ->because('Entities should not have dependency outside App\Entity namespace, except for ApiPlatform, ArrayObject, Doctrine Mapping, Symfony File, Symfony Validator and Vich UploaderBundle');
    }

    public static function entityExceptionNameMustNotEndWithException(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Entity\Exception'))
            ->should(new NotHaveNameMatching('*Exception'))
            ->because('Exception should not be suffixed by Exception in order to be meaningful when suffixed by named constructor');
    }

    public static function entitiesShouldNotThrowDoctrineException(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Entity'))
            ->should(new NotDependsOnTheseNamespaces(
                'Doctrine\ORM\NonUniqueResultException',
                'Doctrine\ORM\NoResultException',
            ))
            ->because('Doctrine Exception should not be used in Entity, catch them in Repository instead, log them and rethrow a specific Exception');
    }
}
