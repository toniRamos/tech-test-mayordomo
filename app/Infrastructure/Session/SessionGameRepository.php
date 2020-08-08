<?php

namespace App\Infrastructure\Session;

use App\Domain\Game\Repository\GameInterface;
use App\Domain\Game\Game;
use App\Domain\Board\Board;

class SessionGameRepository implements GameInterface{
    private const KEY = 'g-';

    public function __construct()
    {
        session_start();
    }

    public function save(Game $game): void
    {
        $data = $game->toArray();
        $_SESSION[self::KEY.$data['id']] = json_encode($data);
    }

    public function findById(string $id): ?Game
    {
        if(isset($_SESSION[self::KEY.$id]))
        {
            return $this->generateGame(json_decode($_SESSION[self::KEY.$id], true));
        } else {
            return null;
        }
    }

    private function generateGame(array $data): Game
    {
        $board = Board::restoreBoard($data['board']);
        return Game::restoreGame($board, $data['turnOff'], $data['id'], $data['state']);
    }
}
