<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\CalcAtto\Token\Number;
use Smeghead\CalcAtto\Token\Operator;
use Smeghead\CalcAtto\Token\TokenException;
use Smeghead\CalcAtto\Token\Tokenizer;

final class TokenizerTest extends TestCase {
    public function test空文字(): void {
        $sut = new Tokenizer();
        $tokens = $sut->tokenize('');

        $this->assertSame(0, count($tokens), '空文字ならトークンなし');
    }

    public function test空白文字(): void {
        $sut = new Tokenizer();
        $tokens = $sut->tokenize(' ');

        $this->assertSame(0, count($tokens), '空白文字ならトークンなし');
    }

    public function test数字(): void {
        $sut = new Tokenizer();
        $tokens = $sut->tokenize('1');

        $this->assertInstanceOf(Number::class, $tokens[0], '数字');
        $this->assertSame('1', $tokens[0]->toString());
    }

    public function testオペレーター(): void {
        $sut = new Tokenizer();
        $tokens = $sut->tokenize('*');

        $this->assertInstanceOf(Operator::class, $tokens[0], 'オペレーター');
        $this->assertSame('*', $tokens[0]->toString());
    }

    public function test簡単な式(): void {
        $sut = new Tokenizer();
        $tokens = $sut->tokenize('2+3');

        $this->assertSame('2', $tokens[0]->toString());
        $this->assertSame('+', $tokens[1]->toString());
        $this->assertSame('3', $tokens[2]->toString());
    }

    public function test不正な文字(): void {
        $this->expectException(TokenException::class);
        $this->expectExceptionMessage('invalid character.');

        $sut = new Tokenizer();
        $tokens = $sut->tokenize('2#3');
    }
}
