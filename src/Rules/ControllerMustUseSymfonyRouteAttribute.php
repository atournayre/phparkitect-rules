<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\HaveAttribute;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ControllerMustUseSymfonyRouteAttribute implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Controller');
    }

    public function should(): Expression
    {
        return new HaveAttribute('Symfony\Component\Routing\Annotation\Route');
    }

    public function because(): string
    {
        return 'Controller should have dependency on Route attribute from Symfony Routing';
    }
}
