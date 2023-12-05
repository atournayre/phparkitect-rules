<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ApiDocumentationOpenApiMisc implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Api\Documentation');
    }

    public function should(): Expression
    {
        return new HaveNameMatching('/OpenApi$/');
    }

    public function because(): string
    {
        return 'API Documentation should have a name with "OpenApi" inside';
    }
}
