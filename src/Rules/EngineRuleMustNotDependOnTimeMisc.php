<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotDependsOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EngineRuleMustNotDependOnTimeMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\EngineRule');
    }

    public function should(): Expression
    {
        return new NotDependsOnTheseNamespaces('Psr\Clock\ClockInterface', 'Symfony\Component\Clock\ClockInterface',);
    }

    public function because(): string
    {
        return 'time should be injected in EngineRule instead of using ClockInterface or Psr ClockInterface directly';
    }
}
