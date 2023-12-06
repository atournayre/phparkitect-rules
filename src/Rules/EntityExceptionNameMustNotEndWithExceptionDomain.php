<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EntityExceptionNameMustNotEndWithExceptionDomain implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Entity\Exception');
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
