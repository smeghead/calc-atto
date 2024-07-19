<?php

declare(strict_types=1);

namespace Smeghead\CalcAtto\Parser;

final class Parser {
    /**
     * @param array<Token> $tokens
     */
    public function parse(array $tokens): string {
        // 最後にevalで計算させるつもりなので、必要な構文解析はあまり無いと考えた。
        // 構文的に明らかにおかしいものだけチェックして例外をスローします。
        //  * 2連続で数字が現れることはないはず
        //  * 2連続でオペレーターが現れることはないはず
        $previous = null;
        foreach ($tokens as $t) {
            if ($previous === null) {
                $previous = $t;
                continue;
            }
            if ($previous::class === $t::class) {
                throw new ParserException('syntax error.');
            }
            $previous = $t;
        }

        return implode(' ', array_map(fn ($t) => $t->toString(), $tokens));
    }
}
