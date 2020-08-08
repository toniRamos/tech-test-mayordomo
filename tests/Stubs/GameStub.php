<?php

namespace Tests\Stubs;

use Tests\Stubs\BoardStub;
use App\Domain\Game\Game;

class GameStub {
    private const ID_DEFAULT = '3a42f98e-2eb3-4096-be23-896adab41645';
    private const STATE_DEFAULT = Game::READY;
    private const TURN_OFF_PLAYER_DEFAULT = Game::PLAYER_ONE;
    
    public static function default(): Game
    {
        return new Game(
            BoardStub::default(),
            self::TURN_OFF_PLAYER_DEFAULT,
            self::ID_DEFAULT,
            self::STATE_DEFAULT
        );
    }
}