<?php

namespace App\Domain\Game\Repository;

use App\Domain\Game\Game;

interface GameInterface
{
    public function save(Game $game): void;

    public function findById(string $id): ?Game;
}
