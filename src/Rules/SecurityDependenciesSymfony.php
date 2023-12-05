<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class SecurityDependenciesSymfony implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Security');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('App\Entity','App\Service','App\Repository','Symfony\Bundle\SecurityBundle\Security','Symfony\Component\HttpFoundation','Symfony\Component\Routing','Symfony\Component\Security',);
    }

    public function because(): string
    {
        return 'Security should have dependency on Entity, Service, Repository and Symfony Security';
    }
}
