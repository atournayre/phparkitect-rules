<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\IsTrait;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class TraitsMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Traits');
    }

    public function should(): Expression
    {
        return new IsTrait();
    }

    public function because(): string
    {
        return 'we want to be sure that there are only traits in a specific namespace';
    }
}
