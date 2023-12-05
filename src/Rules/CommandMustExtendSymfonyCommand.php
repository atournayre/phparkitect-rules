<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\Extend;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class CommandMustExtendSymfonyCommand implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Command');
    }

    public function should(): Expression
    {
        return new Extend('Symfony\Component\Console\Command\Command');
    }

    public function because(): string
    {
        return 'Command should have dependency on Symfony Console Command';
    }
}
