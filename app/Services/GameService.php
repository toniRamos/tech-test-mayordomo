<?php

namespace App\Services;

use App\Domain\Game\Game;

class GameService {
    private $repository;

    public function __construct(){

    }

    public function createGame(string $id):?Game {
        //TODO:: antes de devolverlo deberia de guardarlo tengo un ejemplo en pingController.php
        return Game::initializeGame($id);
    }

}