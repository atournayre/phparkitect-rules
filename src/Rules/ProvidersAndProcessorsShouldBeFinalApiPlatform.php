<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ProvidersAndProcessorsShouldBeFinalApiPlatform implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\State', 'App\State\Provider', 'App\State\Processor',);
    }

    public function should(): Expression
    {
        return new IsFinal();
    }

    public function because(): string
    {
        return 'extending a provider should be done using the decorator pattern';
    }
}
