<?php

namespace App\Domain\Game;

use Illuminate\Support\Str;
use App\Domain\Board\Board;

class Game{
    private $board;
    private $turnOff;
    private $id;
    private $winner;
    private $state;
    public const PLAYER_ONE = 'x';
    public const PLAYER_TWO = 'y';
    public const READY = 'ready';
    public const FINISHED = 'finished';
    public const IN_PROGRESS = 'in progress';
    private const SIZE_BOARD = 6;

    function __construct(Board $board, string $turnOff, string $id, string $state) {
        $this->board = $board;
        $this->turnOff = $turnOff;
        $this->id = $id;
        $this->state = $state;
    }

    public static function initializeGame(string $id): self
    {
        $board = Board::create(self::SIZE_BOARD);
        $board->locatePlayers(self::PLAYER_ONE, self::PLAYER_TWO);

        return new Game(
            $board,
            self::generateTurn(),
            $id,
            self::READY
        );
    }

    public static function restoreGame(Board $board, string $turnOff, string $id, string $state)
    {
        return new Game($board, $turnOff, $id, $state);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'turnOff' => $this->turnOff,
            'state' => $this->state,
            'board' => $this->board->map()
        ];
    }

    private static function generateTurn(): string
    {
        if(rand(0,1) === 0){
            return self::PLAYER_ONE;
        }else{
            return self::PLAYER_TWO;
        }
    }

}