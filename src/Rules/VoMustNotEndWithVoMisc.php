<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class VoMustNotEndWithVoMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\VO');
    }

    public function should(): Expression
    {
        return new NotHaveNameMatching('*VO');
    }

    public function because(): string
    {
        return 'VO should not be suffixed by VO';
    }
}
