<?php

namespace App\Domain\Board;

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
        $this->checkPlayerCell($player,$positionFrom);
        $this->checkRangePositions($positionFrom, $positionTo);
        $this->move($player, $positionFrom, $positionTo);
    }

    private function checkPlayerCell(string $player, int $position)
    {
        if($this->playerInCell($positionFrom) !== $player)
        {
            throw new \Exception('This cell is the other player');
        }
    }

    private function playerInCell(int $position): string
    {
        return $this->map[$position];
    }

    private function move(string $player,int $positionFrom, int $positionTo): void
    {
        //TODO:: Rellenar funcion de mover de X a Y 
        // de momento solo mover y punto, nada de comprobaciones
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