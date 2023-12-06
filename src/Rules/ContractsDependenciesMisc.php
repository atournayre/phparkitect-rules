<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ContractsDependenciesMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Contracts');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('App\Entity','App\DTO','App\VO','DateTimeInterface','Symfony\Component\DependencyInjection\Attribute',);
    }

    public function because(): string
    {
        return 'Interface should only depend on Entity, DTO, VO and DateTimeInterface';
    }
}
