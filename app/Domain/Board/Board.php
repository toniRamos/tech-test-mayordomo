<?php

namespace App\Domain\Board;

use App\Domain\Game\Game;

class Board{
    private $size;
    private $map;

    public function __construct(int $size) {
        if ($size <= 2)
        {
            throw new \Exception('Size must be greater than 2');
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
        $percentaje = $this->size * 0.2;

        list($whole, $decimal) = sscanf($percentaje, '%d.%d');

        if($decimal >= 5){
            $fill = round($this->size * 0.2);
        } else {
            $fill = floor($this->size * 0.2);
        }

        return $fill;
    }

    public function moveTo(string $player, int $positionFrom, int $positionTo): void 
    {
        $this->checkRangePositions($positionFrom, $positionTo);
        $this->checkPlayerCell($player,$positionFrom);
        $this->move($player, $positionFrom, $positionTo);
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
            if($this->map[$i] === Game::PLAYER_ONE) {
                $countPlayerOne++;
            } elseif ($this->map[$i] === Game::PLAYER_TWO) {
                $countPlayerTwo++;
            }
        }

        if($countPlayerOne > $countPlayerTwo) {
            return Game::PLAYER_ONE;
        } else {
            return Game::PLAYER_TWO;
        }
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

        [$minorPosition, $biggerPosition] = $this->getMinorAndBiggerPosition($positionFrom, $positionTo);

        $findSpace = false;
        $findOposite = false;

        $this->map[$positionTo] = $player;

        for($i = $minorPosition; $i <= $biggerPosition; $i++)
        {
            if($this->map[$i] === '') {
                $findSpace = true;
            }
            if($this->map[$i] !== '' && $this->map[$i] !== $player)
            {
                $findOposite = true;
            }
        }

        if(!$findOposite || !$findSpace)
        {
            $this->fillCell($player, $minorPosition, $biggerPosition);
        }
    }

    private function getMinorAndBiggerPosition(int $positionFrom, int $positionTo): array
    {
        if($positionFrom >= $positionTo)
        {
            return [$positionTo, $positionFrom];
        } else {
            return [$positionFrom, $positionTo];
        }
    }

    private function fillCell(string $player,int $positionFrom, int $positionTo)
    {
        for ($i = $positionFrom; $i <= $positionTo; $i++)
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