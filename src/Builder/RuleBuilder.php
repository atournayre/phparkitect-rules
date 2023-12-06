<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Builder;

use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Atournayre\PHPArkitect\Contracts\AndThatInterface;
use Atournayre\PHPArkitect\Contracts\ExceptInterface;
use Atournayre\PHPArkitect\Contracts\RulesInterface;
use Webmozart\Assert\Assert;

final class RuleBuilder
{
    private array $rules = [];

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function add(RulesInterface|ArchRule $rule): self
    {
        $this->rules[] = $rule instanceof ArchRule ? $rule : $this->buildArchRule($rule);
        return $this;
    }

    public function set(array $rules): self
    {
        Assert::allIsInstanceOf($rules, RulesInterface::class);

        foreach ($rules as $rule) {
            $this->add($rule);
        }
        return $this;
    }

    public function rules(): array
    {
        return $this->rules;
    }

    private function buildArchRule(RulesInterface|ExceptInterface|AndThatInterface $rule): ArchRule
    {
        Assert::isInstanceOf($rule, RulesInterface::class);

        $allClasses = Rule::allClasses();

        if ($rule instanceof ExceptInterface) {
            $allClasses = $allClasses->except(...$rule->except());
        }

        $allClasses = $allClasses->that($rule->that());

        if ($rule instanceof AndThatInterface) {
            foreach ($rule->andThat() as $andThatItem) {
                $allClasses = $allClasses->andThat($andThatItem);
            }
        }

        return $allClasses
            ->should($rule->should())
            ->because($rule->because());
    }
}
