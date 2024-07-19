<?php

declare(strict_types=1);

namespace Smeghead\CalcAtto\Token;

interface Token {
    public function toString(): string;
}
