<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Board\Board;

class BoardTest extends TestCase
{
    private $size = 6;

    public function testCreateBoardAndMap()
    {
        $board = Board::create($this->size);
        $map = $board->map();
        $this->assertIsArray($map);
        $this->assertCount($this->size, $map);
    }

    public function testMapIsFillShouldReturnTrue()
    {
        $board = Board::create($this->size);
        $this->assertTrue($board->mapIsFill());
    }

    public function testLocatePlayers()
    {
        $playerOne = 'x';
        $playerTwo = 'y';

        $board = Board::create($this->size);
        $board->locatePlayers($playerOne, $playerTwo);

        $countValues = array_count_values($board->map());
        $expectedCellsFills = $board->getCellPerPlayer();

        $this->assertEquals($expectedCellsFills, $countValues[$playerOne]);
        $this->assertEquals($expectedCellsFills, $countValues[$playerTwo]);
    }

    public function testCellsPerPlayer()
    {
        $board = Board::create($this->size);
        $this->assertEquals(floor(count($board->map()) * 0.2), $board->getCellPerPlayer());
    }

}
