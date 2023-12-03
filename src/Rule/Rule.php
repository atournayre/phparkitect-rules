<?php

namespace Atournayre\PHPArkitect\Rule;

use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\AllClasses;
use Arkitect\Rules\DSL\ArchRule;

class Rule
{
    protected static function allClasses(): AllClasses
    {
        return \Arkitect\Rules\Rule::allClasses();
    }

    protected static function uniformNaming(string $nameMatching): ArchRule
    {
        return self::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\\' . $nameMatching))
            ->should(new HaveNameMatching('*' . $nameMatching))
            ->because('Classes should have a name matching ' . $nameMatching);
    }

    public static function all(): array
    {
        $reflection = new \ReflectionClass(self::class);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_STATIC | \ReflectionMethod::IS_PUBLIC);
        $rules = [];
        $methods = array_filter($methods, function ($method) {
            $methodName = $method->getName();
            return !in_array($methodName, ['all', 'uniformNaming']);
        });

        foreach ($methods as $method) {
            $methodName = $method->getName();
            $rules[] = self::$methodName();
        }
        return $rules;
    }
}
