<?php

namespace App\Http\Controllers;

use Log; 
use App\Services\GameService;
use Illuminate\Support\Str;

class GameController extends Controller{
    private $gameService;

    function __construct(){
        $this->gameService = new GameService;
    }

    public function create($id){
        $game = $this->gameService->createGame($id);
        return response()->json($game->toArray(), 200);
    }

}