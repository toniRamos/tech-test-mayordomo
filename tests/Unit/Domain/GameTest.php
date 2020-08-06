<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Game\Game;

class GameTest extends TestCase
{
    public function testInitializeGame()
    {
        $game = Game::initializeGame();
        $this->assertTrue(true);
    }
}
