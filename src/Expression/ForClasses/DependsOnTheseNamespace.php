<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Expression\ForClasses;

use Arkitect\Analyzer\ClassDescription;
use Arkitect\Exceptions\FailOnFirstViolationException;
use Arkitect\Expression\Description;
use Arkitect\Expression\Expression;
use Arkitect\Rules\Violation;
use Arkitect\Rules\ViolationMessage;
use Arkitect\Rules\Violations;

class DependsOnTheseNamespace implements Expression
{
    private string $namespace;

    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }

    public function describe(ClassDescription $theClass, string $because): Description
    {
        return new Description("should depend on class in these namespace: $this->namespace", $because);
    }

    /**
     * @throws FailOnFirstViolationException
     */
    public function evaluate(ClassDescription $theClass, Violations $violations, string $because): void
    {
        $dependencies = $theClass->getDependencies();

        $filteredDependencies = array_filter($dependencies, function ($dependency) {
            return $dependency->matches($this->namespace);
        });

        if (count($filteredDependencies) > 0) {
            return;
        }

        $violation = Violation::create(
            $theClass->getFQCN(),
            ViolationMessage::withDescription(
                $this->describe($theClass, $because),
                "depends on {$this->namespace}"
            )
        );

        $violations->add($violation);
    }
}
