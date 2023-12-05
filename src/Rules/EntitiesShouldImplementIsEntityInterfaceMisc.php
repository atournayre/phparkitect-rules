<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EntitiesShouldImplementIsEntityInterfaceMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Entity');
    }

    public function should(): Expression
    {
        return new Implement('Atournayre\Component\Doctrine\Contracts\IsEntityInterface');
    }

    public function because(): string
    {
        return 'it simplifies the check of the type of an object, and will be useful in repositories. If not installed, use composer require atournayre/doctrine-component.';
    }
}
