<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Board\Board;
use Tests\Stubs\BoardStub;
use Tests\Stubs\GameStub;

class BoardTest extends TestCase
{
    private $size = 6;

    public function testCreateBoardAndMap()
    {
        $board = BoardStub::defaultWithSize($this->size);
        $map = $board->map();

        $this->assertIsArray($map);
        $this->assertCount($this->size, $map);
    }

    public function testMapIsFillShouldReturnTrue()
    {
        $board = BoardStub::default();
        $this->assertTrue($board->mapIsFill());
    }

    public function testLocatePlayers()
    {
        $playerOne = 'x';
        $playerTwo = 'y';

        $board = BoardStub::defaultWithSize($this->size);
        $board->initializeMap();
        $board->locatePlayers($playerOne, $playerTwo);

        $countValues = array_count_values($board->map());
        $expectedCellsFills = $board->getCellPerPlayer();

        $this->assertEquals($expectedCellsFills, $countValues[$playerOne]);
        $this->assertEquals($expectedCellsFills, $countValues[$playerTwo]);
    }

    public function testCellsPerPlayer()
    {
        $board = BoardStub::defaultWithSize($this->size);
        $this->assertEquals(floor(count($board->map()) * 0.2), $board->getCellPerPlayer());
    }
}
