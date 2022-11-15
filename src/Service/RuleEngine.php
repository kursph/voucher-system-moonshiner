<?php

namespace App\Service;

final class RuleEngine
{
    private array $rules = [];

    public function __construct()
    {
        $this->addRule(fn($fact) => $fact->getTotalAmountVouchers() >= 3, 'You can not create more than 3 vouchers per type!');
    }

    public function addRule(callable $rule, string $message): void
    {
        $this->rules[] = [
            'rule' => $rule,
            'message' => $message,
        ];
    }

    public function validateAny($fact): ?string
    {
        foreach ($this->rules as $rule) {
            if ($rule['rule']($fact)) {
                return $rule['message'];
            }
        }

        return null;
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
