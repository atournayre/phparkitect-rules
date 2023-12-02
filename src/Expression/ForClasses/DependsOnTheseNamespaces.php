<?php

declare(strict_types=1);

namespace Atournayre\PHPArkitect\Expression\ForClasses;

use Arkitect\Analyzer\ClassDescription;
use Arkitect\Expression\Description;
use Arkitect\Expression\Expression;
use Arkitect\Rules\Violation;
use Arkitect\Rules\ViolationMessage;
use Arkitect\Rules\Violations;

class DependsOnTheseNamespaces implements Expression
{
    /** @var string[] */
    private $namespaces;

    public function __construct(string ...$namespace)
    {
        $this->namespaces = $namespace;
    }

    public function describe(ClassDescription $theClass, string $because): Description
    {
        $desc = implode(', ', $this->namespaces);

        return new Description("should depend on classes in one of these namespaces: $desc", $because);
    }

    public function evaluate(ClassDescription $theClass, Violations $violations, string $because): void
    {
        $dependencies = $theClass->getDependencies();

        foreach ($this->namespaces as $namespace) {
            $found = false;
            foreach ($dependencies as $dependency) {
                if ($dependency->getFQCN()->namespace() === $namespace) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $violation = Violation::create(
                    $theClass->getFQCN(),
                    ViolationMessage::withDescription(
                        $this->describe($theClass, $because),
                        "depends on {$namespace}"
                    )
                );

                $violations->add($violation);
            }
        }
    }
}
