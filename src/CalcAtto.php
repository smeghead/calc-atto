<?php

declare(strict_types=1);

namespace Smeghead\CalcAtto;

use ParseError;
use Smeghead\CalcAtto\Parser\Parser;
use Smeghead\CalcAtto\Parser\ParserException;
use Smeghead\CalcAtto\Token\TokenException;
use Smeghead\CalcAtto\Token\Tokenizer;

final class CalcAtto {
    /**
     * @param string $input 入力された式
     * @return mixed 計算結果
     * @throws TokenException 字句解析に失敗した時
     * @throws ParserException パースに失敗した時
     * @throws ParseError `eval` がパースに失敗した時
     */
    public function calc(string $input): mixed {
        $tokenizer = new Tokenizer();
        $tokens = $tokenizer->tokenize($input);

        $parser = new Parser();
        $expression = $parser->parse($tokens);
        if (empty($expression)) {
            return '';
        }
        return eval(sprintf('return %s;', $expression));
    }
}
