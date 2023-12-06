<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EventDependenciesSymfony implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Event');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('App\DTO', 'App\Entity', 'App\VO', 'Symfony\Contracts\EventDispatcher\Event',);
    }

    public function because(): string
    {
        return 'Event should depends only on Entity and Symfony Event';
    }
}
