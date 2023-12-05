<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Atournayre\PHPArkitect\Contracts\RulesInterface;

class UniformNamingForSymfonySecurity extends UniformNaming implements RulesInterface
{
    public string $naming = 'Security';
}
