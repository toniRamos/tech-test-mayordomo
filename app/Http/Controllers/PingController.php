<?php

namespace App\Http\Controllers;

use Log;

class PingController extends Controller{

    function __construct(){
        
    }

    public function ping(){
        return response()->json("pong", 200);
    }
}