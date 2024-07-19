<?php

declare(strict_types=1);

namespace Smeghead\CalcAtto\Token;

final class Number implements Token {
    public function __construct(private string $value) {
    }

    public function toString(): string {
        return $this->value;
    }
}
