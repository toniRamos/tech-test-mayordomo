<?php

namespace Tests\Stubs;

use App\Domain\Board\Board;

class BoardStub {
    private const SIZE_DEFAULT = 6;
    private const MAP_DEFAULT = ['x','','','','','y'];

    public static function default(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_DEFAULT);

        return $board;
    }

    public static function defaultWithSize(int $size): Board
    {
        $board = new Board($size);
        $board->setMap(self::MAP_DEFAULT);

        return $board;
    }

    public static function defaultWithOutLocatePlayer(int $size): Board
    {
        $board = new Board($size);

        return $board;
    }

}