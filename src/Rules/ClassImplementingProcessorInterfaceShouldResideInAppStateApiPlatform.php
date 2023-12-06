<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\IsNotInterface;
use Arkitect\Expression\ForClasses\IsNotTrait;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\AndThatInterface;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ClassImplementingProcessorInterfaceShouldResideInAppStateApiPlatform implements RulesInterface, AndThatInterface
{
    public function that(): Expression
    {
        return new Implement('ApiPlatform\State\ProcessorInterface');
    }

    public function should(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\State', 'App\State\Processor',);
    }

    public function because(): string
    {
        return 'it\'s an ApiPlatform convention for Processors';
    }

    public function andThat(array $expressions): array
    {
        return [
            new IsNotInterface(),
            new IsNotTrait(),
        ];
    }
}
