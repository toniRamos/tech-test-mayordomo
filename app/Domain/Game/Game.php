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
    private const SIZE_BOARD = 6;

    function __construct(Board $board, string $turnOff, string $id, string $state, ?string $winner) {
        $this->board = $board;
        $this->turnOff = $turnOff;
        $this->id = $id;
        $this->state = $state;
        $this->winner = $winner;
    }

    public static function initializeGame(string $id): self
    {
        $board = Board::create(self::SIZE_BOARD);
        $board->locatePlayers(self::PLAYER_ONE, self::PLAYER_TWO);

        return new Game(
            $board,
            self::generateTurn(),
            $id,
            self::READY,
            null
        );
    }

    public static function restoreGame(Board $board, string $turnOff, string $id, string $state, ?string $winner): Game
    {
        return new Game($board, $turnOff, $id, $state, $winner);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'turnOff' => $this->turnOff,
            'state' => $this->state,
            'board' => $this->board->map(),
            'winner' => $this->winner
        ];
    }

    public function movePlayer(string $player, int $positionFrom, int $positionTo): void
    {
        if($this->isGameFinish())
        {
            throw new \Exception('The game is finish');
        }

        if($this->turnOff === $player)
        {
            $this->board->moveTo($player, $positionFrom, $positionTo);
            $this->changePlayerMove();

            if($this->isGameFinish())
            {
                $this->winner = $this->board->planerWin();
                $this->state = self::FINISHED;
            }

        } else {
            throw new \Exception('It is not up to this player to move');
        }
    }

    public function isGameFinish(): bool
    {
        if(!$this->board->existTwoPlayers())
        {
            return true;
        }

        return false;
    }

    public function changePlayerMove(): void 
    {
        if($this->turnOff === self::PLAYER_ONE)
        {
            $this->turnOff = self::PLAYER_TWO;
        } else {
            $this->turnOff = self::PLAYER_ONE;
        }
    }

    public function state(): string
    {
        return $this->state;
    }

    public function turnOff(): string
    {
        return $this->turnOff;
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