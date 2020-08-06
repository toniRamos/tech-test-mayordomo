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

        $this->initializeMap();
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

    private function locatePlayer(string $player, int $fillCells): void
    {
        $countCellsFills = 0;
        while($countCellsFills < $fillCells){
            $cellRandom = rand(0, count($this->map));

            if('' === $this->map[$cellRandom]){
                $this->map[$cellRandom] = $player;
                $countCellsFills++;
            }
        }
    }
}