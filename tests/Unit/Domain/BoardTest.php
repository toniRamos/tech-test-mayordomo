<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Board\Board;
use App\Domain\Game\Game;
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

    public function testMovePlayer()
    {
        $board = BoardStub::defaultWithSize($this->size);
        $board->moveTo('x',0,2);
        $expectedMap = ['x','x','x','','','y'];
        $this->assertEquals($expectedMap, $board->map());
    }

    public function testMovePlayerBackward()
    {
        $board = BoardStub::defaultWithSize($this->size);
        $board->setMap(['','','x','','','y']);
        $board->moveTo('x',2,0);
        $expectedMap = ['x','x','x','','','y'];
        $this->assertEquals($expectedMap, $board->map());
    }

    public function testExceptionPlayerInCell()
    {
        $this->expectException(\Exception::class);

        $board = BoardStub::defaultWithSize($this->size);
        $board->moveTo('y',0,2);
    }

    public function testCheckRangePositionLessThanZero()
    {
        $this->expectException(\Exception::class);

        $board = BoardStub::defaultWithSize($this->size);
        $board->moveTo('x',-1,2);
    }

    public function testCheckRangePositionGreaterThanSix()
    {
        $this->expectException(\Exception::class);

        $board = BoardStub::defaultWithSize($this->size);
        $board->moveTo('x',0,7);
    }

    public function testCanMove()
    {        
        $board = BoardStub::finish();
        $this->assertFalse($board->canMove());
    }

    public function testWinnerPlayerOne()
    {        
        $board = BoardStub::finisWinPlayerOne();
        $winner = $board->planerWin();

        $this->assertEquals(Game::PLAYER_ONE, $winner);
    }

    public function testWinnerPlayerTwo()
    {        
        $board = BoardStub::finisWinPlayerTwo();
        $winner = $board->planerWin();

        $this->assertEquals(Game::PLAYER_TWO, $winner);
    }

    public function testNotWinnerEquals()
    {        
        $board = BoardStub::finish();
        $winner = $board->planerWin();

        $this->assertEquals(Game::PLAYER_ONE.'/'.Game::PLAYER_TWO, $winner);
    }

    public function testOnlyExistOnePlayerInBoard()
    {        
        $board = BoardStub::finisWinPlayerTwoAndFillBoard();
        
        $this->assertFalse($board->existTwoPlayers());
    }

    public function testExistTwoPlayerInBoard()
    {        
        $board = BoardStub::default();
        
        $this->assertTrue($board->existTwoPlayers());
    }

}
