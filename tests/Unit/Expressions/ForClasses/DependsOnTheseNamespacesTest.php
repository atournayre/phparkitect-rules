<?php

namespace Atournayre\PHPArkitect\Tests;

use Arkitect\Analyzer\ClassDependency;
use Arkitect\Analyzer\ClassDescription;
use Arkitect\Rules\Violations;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespaces;
use PHPUnit\Framework\TestCase;

class DependsOnTheseNamespacesTest extends TestCase
{
    public function test_it_should_return_true_when_class_depends_all_namespaces(): void
    {
        $dependOnClasses = new DependsOnTheseNamespaces(
            'myNamespace',
            'anotherNamespace'
        );

        $classDescription = ClassDescription::getBuilder('HappyIsland\Myclass')
            ->addDependency(new ClassDependency('myNamespace\Banana', 0))
            ->addDependency(new ClassDependency('anotherNamespace\Banana', 1))
            ->build();
        $because = 'we want to add this rule for our software';
        $violations = new Violations();
        $dependOnClasses->evaluate($classDescription, $violations, $because);

        self::assertEquals(0, $violations->count());
        self::assertEquals(
            'should depend on classes in one of these namespaces: myNamespace, anotherNamespace because we want to add this rule for our software',
            $dependOnClasses->describe($classDescription, $because)->toString()
        );
    }

    public function test_it_should_return_false_when_class_not_depends_all_namespaces(): void
    {
        $dependOnClasses = new DependsOnTheseNamespaces(
            'myNamespace',
            'anotherNamespace'
        );

        $classDescription = ClassDescription::getBuilder('HappyIsland\Myclass')
            ->addDependency(new ClassDependency('myNamespace\Banana', 0))
            ->build();
        $because = 'we want to add this rule for our software';
        $violations = new Violations();
        $dependOnClasses->evaluate($classDescription, $violations, $because);

        self::assertEquals(1, $violations->count());
        self::assertEquals(
            'should depend on classes in one of these namespaces: myNamespace, anotherNamespace because we want to add this rule for our software',
            $dependOnClasses->describe($classDescription, $because)->toString()
        );
    }
}
