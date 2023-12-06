<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class DtoMustNotEndWithDtoMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\DTO');
    }

    public function should(): Expression
    {
        return new NotHaveNameMatching('*DTO');
    }

    public function because(): string
    {
        return 'DTO should not be suffixed by DTO';
    }
}
