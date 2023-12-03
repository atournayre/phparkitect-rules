<?php

namespace Atournayre\PHPArkitect\Tests;

use Arkitect\Analyzer\ClassDependency;
use Arkitect\Analyzer\ClassDescription;
use Arkitect\Rules\Violations;
use Atournayre\PHPArkitect\Expression\ForClasses\DependsOnTheseNamespace;
use PHPUnit\Framework\TestCase;

class DependsOnTheseNamespacesTest extends TestCase
{
    public function test_it_should_return_true_when_class_depends_on_namespace(): void
    {
        $dependOnClasses = new DependsOnTheseNamespace('myNamespace\Banana');

        $classDescription = ClassDescription::getBuilder('HappyIsland\Myclass')
            ->addDependency(new ClassDependency('myNamespace\Banana', 0))
            ->build();
        $because = 'we want to add this rule for our software';
        $violations = new Violations();
        $dependOnClasses->evaluate($classDescription, $violations, $because);

        self::assertEquals(0, $violations->count());
        self::assertEquals(
            'should depend on class in these namespace: myNamespace\Banana because we want to add this rule for our software',
            $dependOnClasses->describe($classDescription, $because)->toString()
        );
    }

    public function test_it_should_return_false_when_class_not_depends_on_namespace(): void
    {
        $dependOnClasses = new DependsOnTheseNamespace('myNamespace\Banana');

        $classDescription = ClassDescription::getBuilder('HappyIsland\Myclass')
            ->addDependency(new ClassDependency('anotherNamespace\Banana', 0))
            ->build();
        $because = 'we want to add this rule for our software';
        $violations = new Violations();
        $dependOnClasses->evaluate($classDescription, $violations, $because);

        self::assertEquals(1, $violations->count());
        self::assertEquals(
            'should depend on class in these namespace: myNamespace\Banana because we want to add this rule for our software',
            $dependOnClasses->describe($classDescription, $because)->toString()
        );
    }
}
