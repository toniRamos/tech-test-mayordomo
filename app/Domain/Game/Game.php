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
    private const PLAYER_ONE = 'x';
    private const PLAYER_TWO = 'y';
    private const SIZE_BOARD = 6;
    private const READY = 'ready';
    private const FINISHED = 'finished';
    private const IN_PROGRESS = 'in progress';

    function __construct(Board $board, string $turnOff, string $id) {
        $this->board = $board;
        $this->turnOff = $turnOff;
        $this->id = $id;
        $this->state = self::READY;
    }

    public static function initializeGame(string $id): self
    {
        $board = Board::create(self::SIZE_BOARD);
        $board->locatePlayers(self::PLAYER_ONE, self::PLAYER_TWO);

        return new Game(
            $board,
            self::generateTurn(),
            $id
        );
    }

    private static function generateTurn(): string
    {
        if(rand(0,1) === 0){
            return self::PLAYER_ONE;
        }else{
            return self::PLAYER_TWO;
        }
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

}