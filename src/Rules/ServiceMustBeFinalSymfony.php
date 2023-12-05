<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ServiceMustBeFinalSymfony implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Service');
    }

    public function should(): Expression
    {
        return new IsFinal();
    }

    public function because(): string
    {
        return 'Service are not meant to be extended but decorated using Symfony Decorator Pattern';
    }
}
