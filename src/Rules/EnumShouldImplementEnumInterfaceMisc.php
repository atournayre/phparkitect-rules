<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EnumShouldImplementEnumInterfaceMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Enum');
    }

    public function should(): Expression
    {
        return new Implement('App\Contracts\EnumInterface',);
    }

    public function because(): string
    {
        return 'Enum should implement EnumInterface';
    }
}
