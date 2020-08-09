<?php

namespace App\Domain\Board;

use App\Domain\Game\Game;

class Board{
    private $size;
    private $map;

    public function __construct(int $size) {
        if ($size < 0)
        {
            throw new \Exception('Size must be greater than 0');
        }

        $this->size = $size;
    }

    public static function create(int $size): self
    {
        $board = new Board($size);
        $board->initializeMap();
        return $board;
    }

    public static function restoreBoard(array $map)
    {
        $board = new Board(count($map));
        $board->setMap($map);
        return $board;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function initializeMap(): void
    {
        for($i = 0; $i < $this->size; $i++)
        {
            $this->map[$i] = '';
        }
    }

    public function map(): array
    {
        return $this->map;
    }

    public function setMap(array $map): void
    {
        $this->map = $map;
    }

    public function mapIsFill(): bool
    {
        return in_array("", $this->map);
    }

    public function locatePlayers(string $playerOne, string $playerTwo): void
    {
        $cellPerPlayer = $this->getCellPerPlayer();
        $this->locatePlayer($playerOne, $cellPerPlayer);
        $this->locatePlayer($playerTwo, $cellPerPlayer);
    }

    public function getCellPerPlayer(): int 
    {
        return floor($this->size * 0.2);
    }

    public function moveTo(string $player, int $positionFrom, int $positionTo): void 
    {
        $this->checkRangePositions($positionFrom, $positionTo);
        $this->checkPlayerCell($player,$positionFrom);
        $this->move($player, $positionFrom, $positionTo);
    }

    public function canMove(){
        return in_array('', $this->map());
    }

    public function existTwoPlayers(): bool
    {
        $existTwoPlayersInMap = false;

        if(in_array(GAME::PLAYER_ONE, $this->map) && in_array(GAME::PLAYER_TWO, $this->map))
        {
            $existTwoPlayersInMap = true;
        }

        return $existTwoPlayersInMap;

    }

    public function planerWin():string {
        $countPlayerOne = 0;
        $countPlayerTwo = 0;

        for($i = 0; $i < $this->size; $i++)
        {
            if($this->map[$i] === Game::PLAYER_ONE)
            {
                $countPlayerOne++;
            } elseif ($this->map[$i] === Game::PLAYER_TWO) {
                $countPlayerTwo++;
            }
        }

        if($countPlayerOne > $countPlayerTwo)
        {
            return Game::PLAYER_ONE;
        } elseif ($countPlayerTwo > $countPlayerOne) {
            return Game::PLAYER_TWO;
        }

        return Game::PLAYER_ONE.'/'.Game::PLAYER_TWO;
    }

    private function checkPlayerCell(string $player, int $position): void
    {
        if($this->playerInCell($position) !== $player)
        {
            throw new \Exception('This cell is the other player');
        }
    }

    private function playerInCell(int $position): string
    {
        return $this->map[$position];
    }

    private function checkRangePositions(int $positionFrom, int $positionTo): void
    {
        if($positionFrom < 0 || $positionTo >= count($this->map))
        {
            throw new \Exception('The range of motion is wrong');
        }
    }

    private function move(string $player,int $positionFrom, int $positionTo): void
    {
        $minorPosition = 0;
        $biggerPosition = 0;

        if($positionFrom >= $positionTo)
        {
            $biggerPosition = $positionFrom;
            $minorPosition = $positionTo;
        } else {
            $biggerPosition = $positionTo;
            $minorPosition = $positionFrom;
        }

        for($i = $minorPosition; $i <= $biggerPosition; $i++)
        {
            $this->map[$i] = $player;
        }
    }

    private function locatePlayer(string $player, int $fillCells): void
    {
        $countCellsFills = 0;
        while($countCellsFills < $fillCells){
            $cellRandom = rand(0, count($this->map)-1);

            if('' === $this->map[$cellRandom]){
                $this->map[$cellRandom] = $player;
                $countCellsFills++;
            }
        }
    }
}