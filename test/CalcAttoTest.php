<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\CalcAtto\CalcAtto;

final class CalcAttoTest extends TestCase {
    public function test空(): void {
        $sut = new CalcAtto();

        $this->assertSame('', $sut->calc(''));
    }

    public function test数字(): void {
        $sut = new CalcAtto();

        $this->assertSame(1, $sut->calc('1'));
    }

    public function test簡単な式(): void {
        $sut = new CalcAtto();

        $this->assertSame(3, $sut->calc('1+2'));
        $this->assertSame(6, $sut->calc('3*2'));
        $this->assertSame(5, $sut->calc('1 * 2 + 3'));
        $this->assertSame(3.3333333333333335, $sut->calc('10 / 3'), '10 / 3');
    }
}
