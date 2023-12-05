<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EntityExceptionDependenciesMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Entity\Exception');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('App\Entity','App\Enum','App\VO','DateTimeInterface','RuntimeException','Symfony\Component\Uid\Uuid',);
    }

    public function because(): string
    {
        return 'Exception should only depend on Entity, Enum, VO, DateTimeInterface and RuntimeException';
    }
}
