<?php

namespace App\Http\Controllers;

use Log; 
use App\Services\GameService;
use Illuminate\Support\Str;

class GameController extends Controller{
    private const ERROR_MESSAGE_FOUND = 'The game not found';
    private $gameService;


    function __construct(){
        $this->gameService = new GameService();
    }

    public function create($id){
        $game = $this->gameService->createGame($id);
        return response()->json($game->toArray(), 200);
    }

    public function get($id){
        $game = $this->gameService->getGame($id);
        if(null === $game) {
            return response()->json(self::ERROR_MESSAGE_FOUND, 404);
        } else {
            return response()->json($game->toArray(), 200);
        }
    }

    public function move(string $id, string $player, int $positionFrom, int $positionTo)
    {
        $game = $this->gameService->getGame($id);
        try{
            $this->gameService->move($game, $player, $positionFrom, $positionTo);
            return response()->json('Correct move', 200);
        } catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 409);
        }
    }

}