<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Game\Game;
use Tests\Stubs\GameStub;

class GameTest extends TestCase
{
    public function testChangePlayer()
    {
        $game = GameStub::default();
        $expected = GAME::PLAYER_TWO;
        $game->changePlayerMove();
        $this->assertEquals($expected, $game->turnOff());
    }

    public function testIsGameFinishTrue()
    {
        $game = GameStub::finish();
        $this->assertTrue($game->isGameFinish());
    }

    public function testIsGameFinishFalse()
    {
        $game = GameStub::default();
        $this->assertFalse($game->isGameFinish());
    }

    public function testMovePlayer()
    {
        $game = GameStub::default();
        $game->movePlayer(GAME::PLAYER_ONE, 0, 2);
        $expected = ['x','x','x','','','y'];
        $this->assertEquals($expected, $game->toArray()['board']);
    }

}
