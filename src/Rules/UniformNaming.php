<?php

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class UniformNaming implements RulesInterface
{
    protected string $naming = 'UniformNaming';


    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\\'.$this->naming);
    }

    public function should(): Expression
    {
        return new HaveNameMatching('*'.$this->naming);
    }

    public function because(): string
    {
        return 'Classes should have a name matching '.$this->naming;
    }
}
