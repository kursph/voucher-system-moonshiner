<?php

namespace App\Service;

final class RuleEngine
{
    private array $rules = [];

    public function __invoke()
    {
        // insert rule generation here
    }

    public function addRule(callable $rule): void
    {
        $this->rules[] = $rule;
    }

    public function validateAny($fact): bool
    {
        foreach ($this->rules as $rule) {
            if ($rule($fact)) {
                return true;
            }
        }

        return false;
    }

    public function validateAll($fact): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule($fact)) {
                return false;
            }
        }

        return true;
    }
}
