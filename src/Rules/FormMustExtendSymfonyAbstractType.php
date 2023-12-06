<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\Extend;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class FormMustExtendSymfonyAbstractType implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Form\Type');
    }

    public function should(): Expression
    {
        return new Extend('Symfony\Component\Form\AbstractType');
    }

    public function because(): string
    {
        return 'Form should extend Symfony Form AbstractType';
    }
}
