<?php

namespace Tests\Stubs;

use App\Domain\Board\Board;

class BoardStub {
    private const SIZE_DEFAULT = 6;
    private const MAP_DEFAULT = ['x','','','','','y'];
    private const MAP_FINISH_EQUALS = ['x','x','x','y','y','y'];
    private const MAP_FINISH_WIN_PLAYTER_X = ['x','x','x','x','y','y'];
    private const MAP_FINISH_WIN_PLAYTER_Y = ['x','x','y','y','y','y'];
    private const MAP_FINISH_FILL_PLAYTER_Y = ['y','y','y','y','y','y'];

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

    public static function finish(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_EQUALS);

        return $board;
    }

    public static function finisWinPlayerOne(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_WIN_PLAYTER_X);

        return $board;
    }

    public static function finisWinPlayerTwo(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_WIN_PLAYTER_Y);

        return $board;
    }

    public static function finisWinPlayerTwoAndFillBoard(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_FILL_PLAYTER_Y);

        return $board;
    }

}