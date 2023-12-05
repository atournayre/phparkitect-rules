<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Atournayre\PHPArkitect\Contracts\RulesInterface;

class UniformNamingForHttpMisc extends UniformNaming implements RulesInterface
{
    protected string $naming = 'Http';
}
