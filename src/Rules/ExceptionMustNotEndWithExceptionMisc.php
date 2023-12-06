<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ExceptionMustNotEndWithExceptionMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Exception');
    }

    public function should(): Expression
    {
        return new NotHaveNameMatching('*Exception');
    }

    public function because(): string
    {
        return 'Exception should not be suffixed by Exception in order to be meaningful when suffixed by named constructor';
    }
}
