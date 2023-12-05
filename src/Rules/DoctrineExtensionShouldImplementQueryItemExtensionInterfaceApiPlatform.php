<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class DoctrineExtensionShouldImplementQueryItemExtensionInterfaceApiPlatform implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\DoctrineExtension');
    }

    public function should(): Expression
    {
        return new Implement('ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface',);
    }

    public function because(): string
    {
        return 'DoctrineExtension should implement ApiPlatform Doctrine QueryItemExtensionInterface';
    }
}
