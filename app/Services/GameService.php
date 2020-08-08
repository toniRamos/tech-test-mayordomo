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
        $this->repository->save($game);
        return $game;
    }

    public function getGame(string $id): ?Game {
        return $this->repository->findById($id);
    }
}