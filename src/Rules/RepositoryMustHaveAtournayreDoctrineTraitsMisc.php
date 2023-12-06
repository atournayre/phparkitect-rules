<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespace;

class RepositoryMustHaveAtournayreDoctrineTraitsMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Repository');
    }

    public function should(): Expression
    {
        return new DependsOnTheseNamespace('Atournayre\Component\Doctrine\Traits');
    }

    public function because(): string
    {
        return 'Repository should have dependency on Atournayre\Component\Doctrine\Traits, to avoid code duplication and provide useful methods. If not installed, use composer require atournayre/doctrine-component.';
    }
}
