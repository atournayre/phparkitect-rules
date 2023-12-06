<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Atournayre\PHPArkitect\Contracts\RulesInterface;

class UniformNamingForEngineRuleMisc extends UniformNaming implements RulesInterface
{
    protected string $naming = 'EngineRule';
}
