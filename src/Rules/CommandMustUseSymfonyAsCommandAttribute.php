<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\HaveAttribute;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class CommandMustUseSymfonyAsCommandAttribute implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Command');
    }

    public function should(): Expression
    {
        return new HaveAttribute('Symfony\Component\Console\Attribute\AsCommand');
    }

    public function because(): string
    {
        return 'Command should have dependency on AsCommand attribute from Symfony Console';
    }
}
