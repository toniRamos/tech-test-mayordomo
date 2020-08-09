<?php

namespace App\Services;

use App\Domain\Game\Game;
use App\Infrastructure\Session\SessionGameRepository;

class GameService {
    private $repository;

    public function __construct(){
        $this->repository = new SessionGameRepository();
        
    }

    public function createGame(string $id): ?Game {
        $game = Game::initializeGame($id);
        $this->saveGame($game);
        return $game;
    }

    public function getGame(string $id): ?Game {
        return $this->repository->findById($id);
    }

    public function move(Game $game, string $player, int $positionFrom, int $positionTo): void
    {
        if($game->state() === Game::FINISHED)
        {
            throw new \Exception('The game is finish');
        } else {
            $game->movePlayer($player, $positionFrom, $positionTo);
            $this->saveGame($game);
        }
    }

    private function saveGame(Game $game): void
    {
        $this->repository->save($game);
    }

}