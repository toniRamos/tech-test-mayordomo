<?php

namespace App\Domain\Board;

class Board{
    private $size;

    public function __construct($size) {
        if ($size < 0)
        {
            throw new \Exception('Size must be greater than 0');
        }

        $this->size = $size;
    }

    public function size(): int
    {
        return $this->size;
    }
}