<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\CalcAtto\Parser\Parser;
use Smeghead\CalcAtto\Parser\ParserException;
use Smeghead\CalcAtto\Token\Number;
use Smeghead\CalcAtto\Token\Operator;
use Smeghead\CalcAtto\Token\Tokenizer;

final class ParserTest extends TestCase {
    public function test空(): void {
        $sut = new Parser();
        $tokens = [];

        $this->assertSame('', $sut->parse($tokens), '空なら空文字になる');
    }

    public function test数字(): void {
        $sut = new Parser();
        $tokens = [
            new Number('100'),
        ];

        $this->assertSame('100', $sut->parse($tokens));
    }

    public function test簡単な式(): void {
        $sut = new Parser();
        $tokens = [
            new Number('100'),
            new Operator('+'),
            new Number('200'),
        ];

        $this->assertSame('100 + 200', $sut->parse($tokens));
    }

    public function test不正なトークンの並び(): void {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('syntax error.');

        $sut = new Parser();
        $tokens = [
            new Number('100'),
            new Number('200'),
            new Operator('+'),
        ];

        $sut->parse($tokens);
    }
}
