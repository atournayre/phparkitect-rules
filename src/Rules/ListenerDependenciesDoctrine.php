<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ListenerDependenciesDoctrine implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Listener');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener', 'Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener', 'Doctrine\ORM\Event', 'Doctrine\ORM\Events', 'App\Decorator', 'App\DTO', 'App\Entity', 'App\Enum', 'App\Service', 'App\Repository', 'App\VO', 'Symfony\Component\Clock\ClockInterface', 'Webmozart\Assert\Assert',);
    }

    public function because(): string
    {
        return 'Listener should have dependency on AsEntityListener attribute from Doctrine';
    }
}
