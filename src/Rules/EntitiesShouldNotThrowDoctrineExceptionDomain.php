<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EntitiesShouldNotThrowDoctrineExceptionDomain implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Entity');
    }

    public function should(): Expression
    {
        return new NotDependsOnTheseNamespaces('Doctrine\ORM\NonUniqueResultException', 'Doctrine\ORM\NoResultException',);
    }

    public function because(): string
    {
        return 'Doctrine Exception should not be used in Entity, catch them in Repository instead, log them and rethrow a specific Exception';
    }
}
