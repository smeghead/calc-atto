<?php

declare(strict_types=1);

namespace Smeghead\CalcAtto\Token;

final class Tokenizer {
    /**
     * @return array<Token>
     */
    public function tokenize(string $input): array {
        $tokens = [];
        while (!empty($input)) {
            if (preg_match('/^\s+(.*)$/', $input, $matches) === 1) {
                $input = $matches[1];
            } else if (preg_match('/^([0-9]+)(.*)$/', $input, $matches) === 1) {
                $tokens[] = new Number($matches[1]);
                $input = $matches[2];
            } else if (in_array(substr($input, 0, 1), Operator::TYPES)) {
                $tokens[] = new Operator(substr($input, 0, 1));
                $input = substr($input, 1);
            } else {
                throw new TokenException('invalid character.');
            }
        }
        return $tokens;
    }
}
