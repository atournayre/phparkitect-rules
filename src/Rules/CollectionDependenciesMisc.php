<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;
use Webmozart\Assert\Assert;

class CollectionDependenciesMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Collection');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('App\Contracts', 'App\Entity', 'Carbon\Carbon', 'DateTimeInterface', 'Doctrine\Common\Collections\Collection', 'Doctrine\Common\Collections\Criteria', 'Doctrine\Common\Collections\ArrayCollection', 'Doctrine\Common\Collections\ReadableCollection', 'Doctrine\ORM\PersistentCollection', 'Symfony\Contracts', Assert::class,);
    }

    public function because(): string
    {
        return 'Collection should only depend on Entity, Carbon, DateTimeInterface, Doctrine Collection, Doctrine Criteria, Doctrine ReadableCollection, Doctrine PersistentCollection and Webmozart Assert';
    }
}
