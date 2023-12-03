<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;

final class ApiRule extends Rule
{
    public static function uniformNamingForApiResource(): ArchRule
    {
        return self::uniformNaming('ApiResource');
    }

    public static function apiResourceShouldBeFinal(): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\ApiResource'))
            ->should(new IsFinal())
            ->because('ApiResource are not meant to be extended');
    }
}
