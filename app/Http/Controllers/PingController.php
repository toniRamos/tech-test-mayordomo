<?php

namespace App\Http\Controllers;

use Log;

class PingController extends Controller{

    function __construct(){
        
    }

    public function ping(){
        return response()->json("pong", 200);
    }

    public function session(){

        session(['hola' => 'adios123']);

        $valor = session('hola');
        var_dump($valor);
        die;

        return response()->json("hola", 200);
    }

}