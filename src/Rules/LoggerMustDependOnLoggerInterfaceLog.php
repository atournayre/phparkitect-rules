<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespace;

class LoggerMustDependOnLoggerInterfaceLog implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Logger');
    }

    public function should(): Expression
    {
        return new DependsOnTheseNamespace('Psr\Log\LoggerInterface');
    }

    public function because(): string
    {
        return 'Logger must have dependency on LoggerInterface';
    }
}
