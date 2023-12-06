<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\NotHaveDependencyOutsideNamespace;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class EntityDependenciesDomain implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Entity');
    }

    public function should(): Expression
    {
        return new NotHaveDependencyOutsideNamespace('App\Entity', ['ApiPlatform\Doctrine','ApiPlatform\Metadata','ApiPlatform\OpenApi\Model','App\ApiPlatform\Endpoint','App\ApiResource\Groupes','App\Collection','App\Contracts','App\DTO','App\Enum','App\Repository','App\State','App\State\Provider','App\State\Processor','App\VO','ArrayObject','Carbon','DateTimeImmutable','DateTimeInterface','Doctrine\Common\Collections\Collection','Doctrine\Common\Collections\Criteria','Doctrine\Common\Collections\ArrayCollection','Doctrine\DBAL\Types\Types','Doctrine\ORM\Mapping','Doctrine\ORM\PersistentCollection','InvalidArgumentException','RuntimeException','Symfony\Bridge\Doctrine\Validator\Constraints','Symfony\Component\HttpFoundation\File\File','Symfony\Component\Validator\Constraints','Symfony\Component\Uid\Uuid','SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface','Vich\UploaderBundle\Mapping\Annotation','Webmozart\Assert\Assert',]);
    }

    public function because(): string
    {
        return 'Entities should not have dependency outside App\Entity namespace, except for ApiPlatform, ArrayObject, Doctrine Mapping, Symfony File, Symfony Validator and Vich UploaderBundle';
    }
}
