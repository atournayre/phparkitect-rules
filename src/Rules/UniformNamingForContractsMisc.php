<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Atournayre\PHPArkitect\Contracts\RulesInterface;

class UniformNamingForContractsMisc extends UniformNaming implements RulesInterface
{
    protected string $naming = 'Interface';
}
