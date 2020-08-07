<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Game\Game;

class GameTest extends TestCase
{
    private $id = "3a42f98e-2eb3-4096-be23-896adab41645";

    public function testInitializeGame()
    {
        $game = Game::initializeGame($this->id);
        $this->assertTrue(true);
    }
}
