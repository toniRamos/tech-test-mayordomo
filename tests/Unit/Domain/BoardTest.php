<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Board\Board;

class BoardTest extends TestCase
{
    public function testSizeGreatherThanZero()
    {
        $expected = 0;
        $board = new Board($expected);
        $size = $board->size();
        $this->assertIsInt($size);
        $this->assertEquals($size, $expected);
    }

    public function testThrowExceptionSizeNegative()
    {
        $this->expectException(\Exception::class);

        $expected = -1;
        $board = new Board($expected);
    }

}
