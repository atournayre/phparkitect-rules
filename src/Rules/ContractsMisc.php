<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ContractsMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new HaveNameMatching('*Interface');
    }

    public function should(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Contracts');
    }

    public function because(): string
    {
        return 'we want to be sure that there are only interfaces in a specific namespace';
    }
}
