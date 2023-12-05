<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespace;

class CommandMustUseSymfonyStopwatchMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Command');
    }

    public function should(): Expression
    {
        return new DependsOnTheseNamespace('Symfony\Component\Stopwatch\Stopwatch');
    }

    public function because(): string
    {
        return 'we use Stopwatch to measure time of command execution';
    }
}
