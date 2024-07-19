<?php

declare(strict_types=1);

namespace Smeghead\CalcAtto\Token;

final class Operator implements Token {
    public const TYPES = ['+', '-', '*', '/'];

    public function __construct(private string $value) {
        if (!in_array($value, self::TYPES)) {
            throw new \Exception('unknown operator.');
        }
    }

    public function toString(): string {
        return $this->value;
    }
}
