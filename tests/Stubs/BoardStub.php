<?php

namespace Tests\Stubs;

use App\Domain\Board\Board;

class BoardStub {
    private const SIZE_DEFAULT = 6;
    private const MAP_DEFAULT = ['x','','','','','y'];
    private const MAP_MOVE_BEETWIN_Y = ['x','y','','y','',''];
    private const MAP_FINISH_WIN_PLAYER_X = ['x','x','x','x','x','x'];
    private const MAP_FINISH_WIN_PLAYER_Y = ['y','y','y','y','y','y'];

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

    public static function inProgressBeetwing(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_MOVE_BEETWIN_Y);

        return $board;
    }


    public static function finisWinPlayerOne(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_WIN_PLAYER_X);

        return $board;
    }

    public static function finisWinPlayerTwo(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_WIN_PLAYER_Y);

        return $board;
    }

    public static function finisWinPlayerTwoAndFillBoard(): Board
    {
        $board = new Board(self::SIZE_DEFAULT);
        $board->setMap(self::MAP_FINISH_WIN_PLAYER_Y);

        return $board;
    }

}